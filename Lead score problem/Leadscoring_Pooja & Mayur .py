#!/usr/bin/env python
# coding: utf-8

# In[1]:


# Importing required packages:
import numpy as np
import pandas as pd
from datetime import datetime as dt

# For Visualisation we use the below packages:
import matplotlib.pyplot as plt
import seaborn as sns
get_ipython().run_line_magic('matplotlib', 'inline')

# To Scale our data we use the below package:
from sklearn.preprocessing import scale

# Supress Warnings by:
import warnings
warnings.filterwarnings('ignore')

from sklearn.datasets import fetch_openml
from sklearn.decomposition import PCA
from sklearn.preprocessing import StandardScaler
from sklearn import metrics
from sklearn.model_selection import train_test_split

# Import MinMax scaler using below packages:
from sklearn.preprocessing import MinMaxScaler
# Scale the three numeric features
scaler = MinMaxScaler()

# Import 'LogisticRegression' using below:
from sklearn.linear_model import LogisticRegression
logreg = LogisticRegression()

# Import RFE using below:
from sklearn.feature_selection import RFE

# Importing statsmodels using below:
import statsmodels.api as sm

# Importing 'variance_inflation_factor' using below:
from statsmodels.stats.outliers_influence import variance_inflation_factor

# Importing metrics from sklearn for evaluation using below:
from sklearn import metrics

from sklearn.metrics import precision_recall_curve


# In[2]:


#Reading the Data set
leadscoring = pd.read_csv("C:/Users/hp/Downloads/Lead+Scoring+Case+Study/Lead Scoring Assignment/Leads.csv")
leadscoring.head()


# In[3]:


#statistical summary of the data
leadscoring.describe()


# In[4]:


#checking datatypes of the given dataset
leadscoring.dtypes


# In[5]:


##Checking the no. of rows and columns
leadscoring.shape


# ## Data Cleanup 

# In[6]:


#checking duplicates
sum(leadscoring.duplicated(subset = 'Lead Number')) == 0


#  Please Note: From the above step we can see that there are no duplicates

# In[7]:


# Checking for total count and percentage of null values in all columns of the dataframe.

total = pd.DataFrame(leadscoring.isnull().sum().sort_values(ascending=False), columns=['Total'])
percentage = pd.DataFrame(round(100*(leadscoring.isnull().sum()/leadscoring.shape[0]),2).sort_values(ascending=False)                          ,columns=['Percentage'])
pd.concat([total, percentage], axis = 1)


# In[8]:


#Replacing 'Select' value as 'nan'

leadscoring = leadscoring.replace('Select',np.nan)


# In[9]:


# Checking total count and percentage of null values in all columns of the dataframe after 'Select' handling.
total = pd.DataFrame(leadscoring.isnull().sum().sort_values(ascending=False), columns=['Total'])
percentage = pd.DataFrame(round(100*(leadscoring.isnull().sum()/leadscoring.shape[0]),2).sort_values(ascending=False)                          ,columns=['Percentage'])
pd.concat([total, percentage], axis = 1)


# In[10]:


# Checking if there are columns with one unique value since it won't affect our analysis
leadscoring.nunique()


# In[11]:


#Remove columns which has only one unique value
#Deleting the following columns as they have only one unique value and hence cannot be responsible in predicting a successful lead case

"""
Magazine
Receive More Updates About Our Courses
Update me on Supply Chain Content
Update me on Supply Chain Content
I agree to pay the amount through cheque

"""   
leadscoring= leadscoring.loc[:,leadscoring.nunique()!=1]
leadscoring.shape


# In[12]:


total = pd.DataFrame(leadscoring.isnull().sum().sort_values(ascending=False), columns=['Total'])
percentage = pd.DataFrame(round(100*(leadscoring.isnull().sum()/leadscoring.shape[0]),2).sort_values(ascending=False)                          ,columns=['Percentage'])
pd.concat([total, percentage], axis = 1)


# In[13]:


# Removing all the columns that have 35% or more null values and the coloums that are not needed
leadscoring2 = leadscoring.drop(['Asymmetrique Profile Index','Asymmetrique Activity Index','Asymmetrique Activity Score','Asymmetrique Profile Score','Lead Profile','Tags','Lead Quality','How did you hear about X Education','City','Lead Number'],axis=1)
leadscoring2.shape


# In[14]:


leadscoring2.head()


# In[15]:


leadscoring2.info()


# In[16]:


total = pd.DataFrame(leadscoring2.isnull().sum().sort_values(ascending=False), columns=['Total'])
percentage = pd.DataFrame(round(100*(leadscoring2.isnull().sum()/leadscoring2.shape[0]),2).sort_values(ascending=False)                          ,columns=['Percentage'])
pd.concat([total, percentage], axis = 1)


# The top 4 coloumns has highest percentage of null value. Deleteing all those records would lead to loss of data needed for our analysis.So replacing the NaN values with 'not provided'.

# In[17]:


leadscoring2['Specialization'] = leadscoring2['Specialization'].fillna('not provided') 
leadscoring2['What matters most to you in choosing a course'] = leadscoring2['What matters most to you in choosing a course'].fillna('not provided')
leadscoring2['Country'] = leadscoring2['Country'].fillna('not provided')
leadscoring2['What is your current occupation'] = leadscoring2['What is your current occupation'].fillna('not provided')
leadscoring2.info()


# In[18]:


leadscoring2["Specialization"].value_counts()


# In[19]:


total = pd.DataFrame(leadscoring2.isnull().sum().sort_values(ascending=False), columns=['Total'])
percentage = pd.DataFrame(round(100*(leadscoring2.isnull().sum()/leadscoring2.shape[0]),2).sort_values(ascending=False)                          ,columns=['Percentage'])
pd.concat([total, percentage], axis = 1)


# In[20]:


# Checking the percent of lose if the null values are removed
round(100*(sum(leadscoring2.isnull().sum(axis=1) > 1)/leadscoring2.shape[0]),2)


# In[21]:


leadscoring3 = leadscoring2[leadscoring2.isnull().sum(axis=1) <1]


# In[22]:


total = pd.DataFrame(leadscoring3.isnull().sum().sort_values(ascending=False), columns=['Total'])
percentage = pd.DataFrame(round(100*(leadscoring3.isnull().sum()/leadscoring3.shape[0]),2).sort_values(ascending=False)                          ,columns=['Percentage'])
pd.concat([total, percentage], axis = 1)


# In[23]:


#Bucketing the values of the country column
leadscoring3["Country"].value_counts()


# In[24]:


#Bucketing the values of the country column

def slots(x):
    category = ""
    if x == "India":
        category = "india"
    elif x == "not provided":
        category = "not provided"
    else:
        category = "outside india"
    return category

leadscoring3['Country'] = leadscoring3.apply(lambda x:slots(x['Country']), axis = 1)
leadscoring3['Country'].value_counts()


# In[25]:


leadscoring.head()


# In[26]:


# Removing Id values since they are unique for everyone

leadscoring_final = leadscoring3.drop('Prospect ID',1)
leadscoring_final.shape


# In[27]:


leadscoring_final.info()


# In[28]:


leadscoring_final.head()


# # Univariate Analysis

# Categorical Variables

# In[29]:


plt.figure(figsize = (15,30))

plt.subplot(6,2,1)
sns.countplot(leadscoring_final['Lead Origin'])
plt.title('Lead Origin')

plt.subplot(6,2,2)
sns.countplot(leadscoring_final['Do Not Email'])
plt.title('Do Not Email')

plt.subplot(6,2,3)
sns.countplot(leadscoring_final['Do Not Call'])
plt.title('Do Not Call')

plt.subplot(6,2,4)
sns.countplot(leadscoring_final['Country'])
plt.title('Country')

plt.subplot(6,2,5)
sns.countplot(leadscoring_final['Search'])
plt.title('Search')

plt.subplot(6,2,6)
sns.countplot(leadscoring_final['Newspaper Article'])
plt.title('Newspaper Article')

plt.subplot(6,2,7)
sns.countplot(leadscoring_final['X Education Forums'])
plt.title('X Education Forums')

plt.subplot(6,2,8)
sns.countplot(leadscoring_final['Newspaper'])
plt.title('Newspaper')

plt.subplot(6,2,9)
sns.countplot(leadscoring_final['Digital Advertisement'])
plt.title('Digital Advertisement')

plt.subplot(6,2,10)
sns.countplot(leadscoring_final['Through Recommendations'])
plt.title('Through Recommendations')

plt.subplot(6,2,11)
sns.countplot(leadscoring_final['A free copy of Mastering The Interview'])
plt.title('A free copy of Mastering The Interview')

plt.subplot(6,2,12)
sns.countplot(leadscoring_final['Last Notable Activity']).tick_params(axis='x', rotation = 90)
plt.title('Last Notable Activity')


plt.show()


# In[30]:


plt.figure(figsize = (15,10))
sns.countplot(leadscoring_final['Lead Source']).tick_params(axis='x', rotation = 90)
plt.title('Lead Source')
plt.show()


# In[31]:


plt.figure(figsize = (20,30))
plt.subplot(2,2,1)
sns.countplot(leadscoring_final['Specialization']).tick_params(axis='x', rotation = 90)
plt.title('Specialization')
plt.subplot(2,2,2)
sns.countplot(leadscoring_final['What is your current occupation']).tick_params(axis='x', rotation = 90)
plt.title('Current Occupation')
plt.subplot(2,2,3)
sns.countplot(leadscoring_final['What matters most to you in choosing a course']).tick_params(axis='x', rotation = 90)
plt.title('What matters most to you in choosing a course')
plt.subplot(2,2,4)
sns.countplot(leadscoring_final['Last Activity']).tick_params(axis='x', rotation = 90)
plt.title('Last Activity')
plt.show()


# In[32]:


sns.countplot(leadscoring_final['Converted'])
plt.title('Converted("Y variable")')
plt.show()


# **Continuous Variable**

# In[33]:


plt.figure(figsize = (15,10))
plt.subplot(221)
plt.hist(leadscoring_final['TotalVisits'], bins = 200)
plt.title('Total Visits')
plt.xlim(0,25)

plt.subplot(222)
plt.hist(leadscoring_final['Total Time Spent on Website'], bins = 10)
plt.title('Total Time Spent on Website')

plt.subplot(223)
plt.hist(leadscoring_final['Page Views Per Visit'], bins = 20)
plt.title('Page Views Per Visit')
plt.xlim(0,20)
plt.show()


# In[34]:


leadscoring_final.info()


# # Bivariate Analysis

# In[35]:


plt.figure(figsize = (15,5))

plt.subplot(1,2,1)
sns.countplot(x='Lead Origin', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Lead Origin')

plt.subplot(1,2,2)
sns.countplot(x='Lead Source', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Lead Source')
plt.show()


# In[36]:



plt.figure(figsize = (15,5))

plt.subplot(1,2,1)
sns.countplot(x='Do Not Email', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Do Not Email')

plt.subplot(1,2,2)
sns.countplot(x='Do Not Call', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Do Not Call')
plt.show()


# In[37]:


plt.figure(figsize = (15,5))

plt.subplot(1,2,1)
sns.countplot(x='Last Activity', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Last Activity')

plt.subplot(1,2,2)
sns.countplot(x='Country', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Country')
plt.show()


# In[38]:


plt.figure(figsize = (15,5))

plt.subplot(1,2,1)
sns.countplot(x='Specialization', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Specialization')

plt.subplot(1,2,2)
sns.countplot(x='What is your current occupation', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('What is your current occupation')
plt.show()


# In[39]:


plt.figure(figsize = (15,5))

plt.subplot(1,2,1)
sns.countplot(x='What matters most to you in choosing a course', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('What matters most to you in choosing a course')

plt.subplot(1,2,2)
sns.countplot(x='Search', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Search')
plt.show()


# In[40]:


plt.figure(figsize = (15,5))

plt.subplot(1,2,1)
sns.countplot(x='Newspaper Article', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Newspaper Article')

plt.subplot(1,2,2)
sns.countplot(x='X Education Forums', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('X Education Forums')
plt.show()


# In[41]:


plt.figure(figsize = (15,5))

plt.subplot(1,2,1)
sns.countplot(x='Newspaper', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Newspaper')

plt.subplot(1,2,2)
sns.countplot(x='Digital Advertisement', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Digital Advertisement')
plt.show()


# In[42]:


plt.figure(figsize = (15,5))

plt.subplot(1,2,1)
sns.countplot(x='Through Recommendations', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Through Recommendations')

plt.subplot(1,2,2)
sns.countplot(x='A free copy of Mastering The Interview', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('A free copy of Mastering The Interview')
plt.show()


# In[43]:


plt.figure(figsize = (15,5))
sns.countplot(x='Last Notable Activity', hue='Converted', data= leadscoring_final).tick_params(axis='x', rotation = 90)
plt.title('Last Notable Activity')
plt.show()


# In[44]:


# To check the correlation among varibles
plt.figure(figsize=(10,5))
ax=sns.heatmap(leadscoring_final.corr(),annot = True , cmap="coolwarm")
bottom,top = ax.get_ylim()
ax.set_ylim(bottom + 0.5, top - 0.5)
plt.show()


# Outliers Analysis and Handling

# In[45]:


numeric = leadscoring_final[['TotalVisits','Total Time Spent on Website','Page Views Per Visit']]
numeric.describe()


# In[46]:


fig, axs = plt.subplots(2, 2,figsize=(10,10))


axs[0, 0].boxplot(leadscoring_final.TotalVisits)
axs[0, 0].set_title('TotalVisits')
axs[0, 1].boxplot(leadscoring_final["Total Time Spent on Website"])
axs[0, 1].set_title('Total Time Spent on Website')
axs[1, 0].boxplot(leadscoring_final["Page Views Per Visit"])
axs[1, 0].set_title('Page Views Per Visit')


# In[47]:


column_list=['TotalVisits','Total Time Spent on Website','Page Views Per Visit']
for column in column_list: 
    Q1=leadscoring_final[column].quantile(0.01)
    Q3=leadscoring_final[column].quantile(0.99)
    IQR=Q3-Q1
    leads_final=leadscoring_final[(leadscoring_final[column]>=Q1) & (leadscoring_final[column]<=Q3)]


# In[48]:


numeric = leadscoring_final[['TotalVisits','Total Time Spent on Website','Page Views Per Visit']]
numeric.describe()


# # Data Preparation

# Create dummy variables out of categrical variables

# In[49]:


leadscoring_final.shape


# In[50]:


leadscoring_final.loc[:, leadscoring_final.dtypes == 'object'].columns


# In[51]:


# Create dummy variables using the 'get_dummies'
dummy = pd.get_dummies(leadscoring_final[['Lead Origin','Specialization' ,'Lead Source', 'Do Not Email', 'Last Activity', 'What is your current occupation','A free copy of Mastering The Interview', 'Last Notable Activity']], drop_first=True)
# Add the results to the master dataframe
leadscoring_final_dum = pd.concat([leadscoring_final, dummy], axis=1)
leadscoring_final_dum.head()


# In[52]:


leadscoring_final_dum = leadscoring_final_dum.drop(['What is your current occupation_not provided','Lead Origin', 'Lead Source', 'Do Not Email', 'Do Not Call','Last Activity', 'Country', 'Specialization', 'Specialization_not provided','What is your current occupation','What matters most to you in choosing a course', 'Search','Newspaper Article', 'X Education Forums', 'Newspaper','Digital Advertisement', 'Through Recommendations','A free copy of Mastering The Interview', 'Last Notable Activity'], 1)
leadscoring_final_dum.head()


# # Test-Train Split

# In[53]:


X = leadscoring_final_dum.drop(['Converted'], 1)
X.head()


# In[54]:


# Putting the target variable in y
y = leadscoring_final_dum['Converted']
y.head()


# In[55]:


# Split the dataset into 70% and 30% for train and test respectively
X_train, X_test, y_train, y_test = train_test_split(X, y, train_size=0.7, test_size=0.3, random_state=10)


# # Feature Scaling

# In[56]:


X_train[['TotalVisits', 'Page Views Per Visit', 'Total Time Spent on Website']] = scaler.fit_transform(X_train[['TotalVisits', 'Page Views Per Visit', 'Total Time Spent on Website']])
X_train.head()


# Checking for correlations

# In[57]:


# To check the correlation among varibles
plt.figure(figsize=(20,30))
sns.heatmap(X_train.corr() , cmap = "coolwarm" )
bottom,top = ax.get_ylim()
ax.set_ylim(bottom + 0.5, top - 0.5)
plt.show()


# We will be using RFE to select variable Since there are a lot of variables and it is difficult to drop them.

# # Model Building

# In[58]:


# Running RFE with 15 variables as output
rfe = RFE(logreg, 15)
rfe = rfe.fit(X_train, y_train)


# In[59]:


# Features that have been selected by RFE
list(zip(X_train.columns, rfe.support_, rfe.ranking_))


# In[60]:


# Put all the columns selected by RFE in the variable 'col'
col = X_train.columns[rfe.support_]
col


# In[61]:


# Selecting columns selected by RFE
X_train = X_train[col]


# In[62]:


X_train_sm = sm.add_constant(X_train)
logm1 = sm.GLM(y_train, X_train_sm, family = sm.families.Binomial())
res = logm1.fit()
res.summary()


# In[63]:


# Make a VIF dataframe for all the variables present
vif = pd.DataFrame()
vif['Features'] = X_train.columns
vif['VIF'] = [variance_inflation_factor(X_train.values, i) for i in range(X_train.shape[1])]
vif['VIF'] = round(vif['VIF'], 2)
vif = vif.sort_values(by = "VIF", ascending = False)
vif


# In[64]:


col = col.drop('What is your current occupation_Housewife', 1)
col


# In[65]:


# Selecting columns selected by RFE
X_train = X_train[col]


# In[66]:


X_train_sm = sm.add_constant(X_train)
logm2 = sm.GLM(y_train, X_train_sm, family = sm.families.Binomial())
res1 = logm2.fit()
res1.summary()


# In[67]:


# Make a VIF dataframe for all the variables present
vif = pd.DataFrame()
vif['Features'] = X_train.columns
vif['VIF'] = [variance_inflation_factor(X_train.values, i) for i in range(X_train.shape[1])]
vif['VIF'] = round(vif['VIF'], 2)
vif = vif.sort_values(by = "VIF", ascending = False)
vif


# In[68]:


col = col.drop('Last Notable Activity_Had a Phone Conversation', 1)
col


# In[69]:


# Selecting columns selected by RFE
X_train = X_train[col]


# In[70]:


X_train_sm = sm.add_constant(X_train)
logm3 = sm.GLM(y_train, X_train_sm, family = sm.families.Binomial())
res2 = logm3.fit()
res2.summary()


# In[71]:


# Make a VIF dataframe for all the variables present
vif = pd.DataFrame()
vif['Features'] = X_train.columns
vif['VIF'] = [variance_inflation_factor(X_train.values, i) for i in range(X_train.shape[1])]
vif['VIF'] = round(vif['VIF'], 2)
vif = vif.sort_values(by = "VIF", ascending = False)
vif


# All the P-values and VIF values are in good range.So we can fix this model and move on to creating the prediction

# In[72]:


# Slightly alter the figure size to make it more horizontal.
plt.figure(figsize=(15,8), dpi=80, facecolor='w', edgecolor='k', frameon='True')

cor = X_train[col].corr()
ax = sns.heatmap(cor, annot=True, cmap="coolwarm")

bottom,top = ax.get_ylim()
ax.set_ylim(bottom + 0.5, top - 0.5)

plt.tight_layout()
plt.show()


# plt.show()
# Our latest model have the following features:
# 
# All variables have low p-value
# All the features have very low VIF values, meaning, there is hardly any muliticollinearity among the features. This is also evident from the heat map

# # Creating Prediction

# In[73]:


# Predicting the probabilities on the train set
y_train_pred = res2.predict(X_train_sm)
y_train_pred[:10]


# In[74]:


# Reshaping to an array
y_train_pred = y_train_pred.values.reshape(-1)
y_train_pred[:10]


# In[75]:


# Data frame with given convertion rate and probablity of predicted ones
y_train_pred_final = pd.DataFrame({'Converted':y_train.values, 'Conversion_Prob':y_train_pred})
y_train_pred_final['LeadID'] = y_train.index
y_train_pred_final.head()


# In[76]:


# Substituting 0 or 1 with the cut off as 0.5
y_train_pred_final['Predicted'] = y_train_pred_final.Conversion_Prob.map(lambda x: 1 if x > 0.5 else 0)

y_train_pred_final['Lead_Score']=y_train_pred_final['Conversion_Prob'].apply(lambda x:int(x*100))
y_train_pred_final.head()


# # Model Evaluation

# In[77]:


# Creating confusion matrix 
confusion = metrics.confusion_matrix(y_train_pred_final.Converted, y_train_pred_final.Predicted )
confusion


# In[78]:


# Check the overall accuracy
metrics.accuracy_score(y_train_pred_final.Converted, y_train_pred_final.Predicted)


# In[79]:


# Substituting the value of true positive
TP = confusion[1,1]
# Substituting the value of true negatives
TN = confusion[0,0]
# Substituting the value of false positives
FP = confusion[0,1] 
# Substituting the value of false negatives
FN = confusion[1,0]


# In[80]:


# Calculating the sensitivity
TP/(TP+FN)


# In[81]:



# Calculating the specificity
TN/(TN+FP)


# # Plotting the ROC Curve

# In[82]:


# ROC function
def draw_roc( actual, probs ):
    fpr, tpr, thresholds = metrics.roc_curve( actual, probs,
                                              drop_intermediate = False )
    auc_score = metrics.roc_auc_score( actual, probs )
    plt.figure(figsize=(5, 5))
    plt.plot( fpr, tpr, label='ROC curve (area = %0.2f)' % auc_score )
    plt.plot([0, 1], [0, 1], 'k--')
    plt.xlim([0.0, 1.0])
    plt.ylim([0.0, 1.05])
    plt.xlabel('False Positive Rate or [1 - True Negative Rate]')
    plt.ylabel('True Positive Rate')
    plt.title('Receiver operating characteristic example')
    plt.legend(loc="lower right")
    plt.show()

    return None


# In[83]:


fpr, tpr, thresholds = metrics.roc_curve( y_train_pred_final.Converted, y_train_pred_final.Conversion_Prob, drop_intermediate = False )


# In[84]:


# Call the ROC function
draw_roc(y_train_pred_final.Converted, y_train_pred_final.Conversion_Prob)


# Calculating the area under the curve(GINI)

# In[85]:


def auc_val(fpr,tpr):
    AreaUnderCurve = 0.
    for i in range(len(fpr)-1):
        AreaUnderCurve += (fpr[i+1]-fpr[i]) * (tpr[i+1]+tpr[i])
    AreaUnderCurve *= 0.5
    return AreaUnderCurve


# In[86]:


auc = auc_val(fpr,tpr)
auc


# # Finding Optimal Cutoff Point

# Optimal cutoff probability is that prob where we get balanced sensitivity and specificity

# In[87]:


# Creating columns with different probability cutoffs 
numbers = [float(x)/10 for x in range(10)]
for i in numbers:
    y_train_pred_final[i]= y_train_pred_final.Conversion_Prob.map(lambda x: 1 if x > i else 0)
y_train_pred_final.head()


# In[88]:


# Creating a dataframe to see the values of accuracy, sensitivity, and specificity at different values of probabiity cutoffs
cutoff_df = pd.DataFrame( columns = ['prob','accuracy','sensi','speci'])
# Making confusing matrix to find values of sensitivity, accurace and specificity for each level of probablity
from sklearn.metrics import confusion_matrix
num = [0.0,0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9]
for i in num:
    cm1 = metrics.confusion_matrix(y_train_pred_final.Converted, y_train_pred_final[i] )
    total1=sum(sum(cm1))
    accuracy = (cm1[0,0]+cm1[1,1])/total1
    
    speci = cm1[0,0]/(cm1[0,0]+cm1[0,1])
    sensi = cm1[1,1]/(cm1[1,0]+cm1[1,1])
    cutoff_df.loc[i] =[ i ,accuracy,sensi,speci]
cutoff_df


# In[89]:


# Plotting it
plt.figure(figsize = (20,10))
cutoff_df.plot.line(x='prob', y=['accuracy','sensi','speci'])
plt.axvline(x=0.335, c='black', lw=2, linestyle='--')
plt.show()


# In[90]:


y_train_pred_final['final_predicted'] = y_train_pred_final.Conversion_Prob.map( lambda x: 1 if x > 0.335 else 0)
y_train_pred_final.head()


# In[91]:


# Check the overall accuracy
metrics.accuracy_score(y_train_pred_final.Converted, y_train_pred_final.final_predicted)


# In[92]:


# Creating confusion matrix 
confusion2 = metrics.confusion_matrix(y_train_pred_final.Converted, y_train_pred_final.final_predicted )
confusion2


# In[93]:


# Substituting the value of true positive
TP = confusion2[1,1]
# Substituting the value of true negatives
TN = confusion2[0,0]
# Substituting the value of false positives
FP = confusion2[0,1] 
# Substituting the value of false negatives
FN = confusion2[1,0]


# In[94]:


# Calculating the sensitivity
TP/(TP+FN)


# In[95]:


# Calculating the specificity
TN/(TN+FP)


# # Precision-Recall

# In[96]:


confusion = metrics.confusion_matrix(y_train_pred_final.Converted, y_train_pred_final.Predicted )
confusion


# In[97]:


# Precision = TP / TP + FP
confusion[1,1]/(confusion[0,1]+confusion[1,1])


# In[98]:


#Recall = TP / TP + FN
confusion[1,1]/(confusion[1,0]+confusion[1,1])


# # Precision and Recall TradeOff

# In[99]:


y_train_pred_final.Converted, y_train_pred_final.Predicted


# In[100]:


p, r, thresholds = precision_recall_curve(y_train_pred_final.Converted, y_train_pred_final.Conversion_Prob)


# In[101]:


plt.plot(thresholds, p[:-1], "g-")
plt.plot(thresholds, r[:-1], "r-")
plt.axvline(x=0.42, c='black', lw=2, linestyle='--')
plt.show()


# From the precision-recall graph above, we get the optical threshold value as close to 0.42

# In[102]:


y_train_pred_final['final_predicted'] = y_train_pred_final.Conversion_Prob.map(lambda x: 1 if x > 0.42 else 0)
y_train_pred_final.head()


# In[103]:


# Accuracy
metrics.accuracy_score(y_train_pred_final.Converted, y_train_pred_final.final_predicted)


# In[104]:


# Creating confusion matrix again
confusion2 = metrics.confusion_matrix(y_train_pred_final.Converted, y_train_pred_final.final_predicted )
confusion2


# In[105]:


# Substituting the value of true positive
TP = confusion2[1,1]
# Substituting the value of true negatives
TN = confusion2[0,0]
# Substituting the value of false positives
FP = confusion2[0,1] 
# Substituting the value of false negatives
FN = confusion2[1,0]


# In[106]:


# Precision = TP / TP + FP
TP / (TP + FP)


# In[107]:


#Recall = TP / TP + FN
TP / (TP + FN)


# # Prediction on Test Set

# In[108]:


# Scaling numeric values
X_test[['TotalVisits', 'Page Views Per Visit', 'Total Time Spent on Website']] = scaler.transform(X_test[['TotalVisits', 'Page Views Per Visit', 'Total Time Spent on Website']])


# In[109]:


# Substituting all the columns in the final train model
col = X_train.columns


# In[110]:


# Select the columns in X_train for X_test as well
X_test = X_test[col]
# Add a constant to X_test
X_test_sm = sm.add_constant(X_test[col])
X_test_sm.head()


# In[111]:


# Storing prediction of test set in the variable 'y_test_pred'
y_test_pred = res2.predict(X_test_sm)
# Coverting it to df
y_pred_df = pd.DataFrame(y_test_pred)
# Converting y_test to dataframe
y_test_df = pd.DataFrame(y_test)
y_test_df['LeadID'] = y_test_df.index
# Remove index for both dataframes to append them side by side 
y_pred_df.reset_index(drop=True, inplace=True)
y_test_df.reset_index(drop=True, inplace=True)
# Append y_test_df and y_pred_df
y_pred_final = pd.concat([y_test_df, y_pred_df],axis=1)
# Renaming column 
y_pred_final= y_pred_final.rename(columns = {0 : 'Conversion_Prob'})

y_pred_final.head()


# In[112]:


# Making prediction using cut off 0.35
y_pred_final['final_predicted'] = y_pred_final.Conversion_Prob.map(lambda x: 1 if x > 0.335 else 0)
y_pred_final['Lead_Score']=y_pred_final['Conversion_Prob'].apply(lambda x:int(x*100))
y_pred_final.head()


# In[113]:


# Check the overall accuracy
metrics.accuracy_score(y_pred_final['Converted'], y_pred_final.final_predicted)


# In[114]:


# Creating confusion matrix 
confusion2 = metrics.confusion_matrix(y_pred_final['Converted'], y_pred_final.final_predicted )
confusion2


# In[115]:


# Substituting the value of true positive
TP = confusion2[1,1]
# Substituting the value of true negatives
TN = confusion2[0,0]
# Substituting the value of false positives
FP = confusion2[0,1] 
# Substituting the value of false negatives
FN = confusion2[1,0]


# In[116]:


# Calculating the sensitivity
TP/(TP+FN)


# In[117]:


# Calculating the specificity
TN/(TN+FP)


# In[118]:


# Storing prediction of test set in the variable 'y_test_pred'
y_test_pred = res2.predict(X_test_sm)
# Coverting it to df
y_pred_df = pd.DataFrame(y_test_pred)
# Converting y_test to dataframe
y_test_df = pd.DataFrame(y_test)
y_test_df['LeadID'] = y_test_df.index
# Remove index for both dataframes to append them side by side 
y_pred_df.reset_index(drop=True, inplace=True)
y_test_df.reset_index(drop=True, inplace=True)
# Append y_test_df and y_pred_df
y_pred_final = pd.concat([y_test_df, y_pred_df],axis=1)
# Renaming column 
y_pred_final= y_pred_final.rename(columns = {0 : 'Conversion_Prob'})
y_pred_final.head()


# In[119]:


# Making prediction using cut off 0.41
y_pred_final['final_predicted'] = y_pred_final.Conversion_Prob.map(lambda x: 1 if x > 0.41 else 0)
y_pred_final['Lead_Score']=y_pred_final['Conversion_Prob'].apply(lambda x:int(x*100))
y_pred_final.head()


# In[120]:


# Check the overall accuracy
metrics.accuracy_score(y_pred_final['Converted'], y_pred_final.final_predicted)


# In[121]:


# Creating confusion matrix 
confusion2 = metrics.confusion_matrix(y_pred_final['Converted'], y_pred_final.final_predicted )
confusion2


# In[122]:


# Substituting the value of true positive
TP = confusion2[1,1]
# Substituting the value of true negatives
TN = confusion2[0,0]
# Substituting the value of false positives
FP = confusion2[0,1] 
# Substituting the value of false negatives
FN = confusion2[1,0]


# In[123]:


# Precision = TP / TP + FP
TP / (TP + FP)


# In[124]:


#Recall = TP / TP + FN
TP / (TP + FN)


# # Calculating Lead score for the entire dataset
# 

# In[125]:


# Selecting the test dataset along with the Conversion Probability and final predicted value for 'Converted'
leads_test_pred = y_pred_final.copy()
leads_test_pred.head()


# In[126]:


# Selecting the train dataset along with the Conversion Probability and final predicted value for 'Converted'
leads_train_pred = y_train_pred_final.copy()
leads_train_pred.head()


# In[127]:


# Dropping unnecessary columns from train dataset
leads_train_pred = leads_train_pred[['LeadID','Converted','Conversion_Prob','final_predicted']]
leads_train_pred.head()


# In[128]:


# Concatenating the 2 dataframes train and test along the rows with the append() function
lead_full_pred = leads_train_pred.append(leads_test_pred)
lead_full_pred.head()


# In[129]:


# Inspecting the shape of the final dataframe and the test and train dataframes
print(leads_train_pred.shape)
print(leads_test_pred.shape)
print(lead_full_pred.shape)


# In[130]:


# Ensuring the LeadIDs are unique for each lead in the finl dataframe
len(lead_full_pred['LeadID'].unique().tolist())


# In[131]:


# Lead Score = 100 * Conversion_Prob
lead_full_pred['Lead_Score'] = lead_full_pred['Conversion_Prob'].apply(lambda x : round(x*100))
lead_full_pred.head()


# In[132]:


# We willlater join it with the original_leads dataframe based on index
lead_full_pred = lead_full_pred.set_index('LeadID').sort_index(axis = 0, ascending = True)
lead_full_pred.head()


# In[133]:


# Slicing the Lead Number column from original leads dataframe
leadscoring = leadscoring[['Lead Number']]
leadscoring.head()


# **Concatenating the 2 dataframes based on index.**
# 
# **This is done so that Lead Score is associated to the Lead Number of each Lead. This will help in quick identification of the lead.**

# In[134]:


# Concatenating the 2 dataframes based on index and displaying the top 10 rows
# This is done son that Lead Score is associated to the Lead Number of each Lead. This will help in quick identification of the lead.
leads_with_score = pd.concat([leadscoring, lead_full_pred], axis=1)
leads_with_score.head(10)


# # Determining Feature Importance

# In[135]:


pd.options.display.float_format = '{:.2f}'.format
new_params = res2.params[1:]
new_params


# In[136]:


#feature_importance = abs(new_params)
feature_importance = new_params
feature_importance = 100.0 * (feature_importance / feature_importance.max())
feature_importance


# Sorting the feature variables based on their relative coefficient values

# In[137]:


sorted_idx = np.argsort(feature_importance,kind='quicksort',order='list of str')
sorted_idx


# **Plot showing the feature variables based on their relative coefficient values**

# In[138]:


pos = np.arange(sorted_idx.shape[0]) + .5

featfig = plt.figure(figsize=(10,6))
featax = featfig.add_subplot(1, 1, 1)
featax.barh(pos, feature_importance[sorted_idx], align='center', color = 'tab:red',alpha=0.8)
featax.set_yticks(pos)
featax.set_yticklabels(np.array(X_train[col].columns)[sorted_idx], fontsize=12)
featax.set_xlabel('Relative Feature Importance', fontsize=14)

plt.tight_layout()   
plt.show()


# Selecting Top 3 features which contribute most towards the probability of a lead getting converted

# In[139]:


pd.DataFrame(feature_importance).reset_index().sort_values(by=0,ascending=False).head(3)


# In[ ]:




