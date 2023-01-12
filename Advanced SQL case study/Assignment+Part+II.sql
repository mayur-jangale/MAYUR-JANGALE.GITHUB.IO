use supply_db ;

/*  Question: Month-wise NIKE sales

	Description:
		Find the combined month-wise sales and quantities sold for all the Nike products. 
        The months should be formatted as ‘YYYY-MM’ (for example, ‘2019-01’ for January 2019). 
        Sort the output based on the month column (from the oldest to newest). The output should have following columns :
			-Month
			-Quantities_sold
			-Sales
		HINT:
			Use orders, ordered_items, and product_info tables from the Supply chain dataset.
*/		

select DATE_FORMAT(Order_Date, '%Y-%m') as month, sum(Quantity) as Quantities_sold, sum(Sales) as sales from orders
left join ordered_items on orders.Order_Id = ordered_items.Order_Id
left join product_info on product_id = item_id
where product_name like "%Nike%"
group by month;



-- **********************************************************************************************************************************
/*

Question : Costliest products

Description: What are the top five costliest products in the catalogue? Provide the following information/details:
-Product_Id
-Product_Name
-Category_Name
-Department_Name
-Product_Price

Sort the result in the descending order of the Product_Price.

HINT:
Use product_info, category, and department tables from the Supply chain dataset.

*/
 select product_id,Product_Name,category.name as category_name, department.name as department_name, Product_Price from product_info
 left join category on category.id = product_info.Category_id
  left join department on department.id = product_info.department_id
  order by Product_Price desc
  limit 5;

-- **********************************************************************************************************************************

/*

Question : Cash customers

Description: Identify the top 10 most ordered items based on sales from all the ‘CASH’ type orders. 
Provide the Product Name, Sales, and Distinct Order count for these items. Sort the table in descending
 order of Order counts and for the cases where the order count is the same, sort based on sales (highest to
 lowest) within that group.
 
HINT: Use orders, ordered_items, and product_info tables from the Supply chain dataset.

*/
select product_name, sum(sales) as sales, count(ordered_items.Order_Id) as order_count from product_info
left join ordered_items on product_id = item_id
left join orders on orders.order_id = ordered_items.Order_Id
group by product_name 
order by order_count, sales desc;

-- **********************************************************************************************************************************
/*
Question : Customers from texas

Obtain all the details from the Orders table (all columns) for customer orders in the state of Texas (TX),
whose street address contains the word ‘Plaza’ but not the word ‘Mountain’. The output should be sorted by the Order_Id.

HINT: Use orders and customer_info tables from the Supply chain dataset.

*/
select Order_Id,Type,Real_Shipping_Days,Scheduled_Shipping_Days,Customer_Id,Order_City,Order_Date,Order_Region,Order_State,Order_Status,Shipping_Mode
from orders 
left join customer_info ci on ci.Id = orders.Customer_Id
where ci.State = "TX" and ci.street like "%Plaza%" and ci.street not like "%Mountain%"
order by order_id;


-- **********************************************************************************************************************************
/*
 
Question: Home office

For all the orders of the customers belonging to “Home Office” Segment and have ordered items belonging to
“Apparel” or “Outdoors” departments. Compute the total count of such orders. The final output should contain the 
following columns:
-Order_Count

*/
select count(order_id) as Order_Count from orders 
left join customer_info ci on orders.customer_id = ci.Id
left join product_info on product_info.product_id = orders.Customer_Id
left join department on product_info.Department_Id = department.id
where ci.segment = 'Home Office' and department.name in ("Apparel","Outdoors");




-- **********************************************************************************************************************************
/*

Question : Within state ranking
 
For all the orders of the customers belonging to “Home Office” Segment and have ordered items belonging
to “Apparel” or “Outdoors” departments. Compute the count of orders for all combinations of Order_State and Order_City. 
Rank each Order_City within each Order State based on the descending order of their order count (use dense_rank). 
The states should be ordered alphabetically, and Order_Cities within each state should be ordered based on their rank. 
If there is a clash in the city ranking, in such cases, it must be ordered alphabetically based on the city name. 
The final output should contain the following columns:
-Order_State
-Order_City
-Order_Count
-City_rank

HINT: Use orders, ordered_items, product_info, customer_info, and department tables from the Supply chain dataset.

*/

SELECT O.ORDER_STATE AS ORDER_STATE,O.ORDER_CITY AS ORDER_CITY,COUNT(O.ORDER_ID) AS Order_Count, DENSE_RANK() OVER (PARTITION BY O.ORDER_STATE ORDER BY COUNT(O.ORDER_ID) DESC) AS CITY_RANK
FROM ORDERS O 
LEFT JOIN 
CUSTOMER_INFO C
ON O.CUSTOMER_ID=C.ID
LEFT JOIN 
ORDERED_ITEMS O1
ON O1.ORDER_ID=O.ORDER_ID
LEFT JOIN 
PRODUCT_INFO P
ON P.PRODUCT_ID=O1.ITEM_ID
LEFT JOIN 
CATEGORY C1
ON C1.ID=P.CATEGORY_ID
LEFT JOIN 
DEPARTMENT D
ON D.ID=P.DEPARTMENT_ID
WHERE C.SEGMENT='Home Office' AND (D.NAME='Apparel' OR D.NAME='Outdoors')
GROUP BY O.ORDER_CITY,O.ORDER_STATE
ORDER BY O.ORDER_STATE ASC,CITY_RANK ASC,O.ORDER_CITY ASC;



-- **********************************************************************************************************************************
/*
Question : Underestimated orders

Rank (using row_number so that irrespective of the duplicates, so you obtain a unique ranking) the 
shipping mode for each year, based on the number of orders when the shipping days were underestimated 
(i.e., Scheduled_Shipping_Days < Real_Shipping_Days). The shipping mode with the highest orders that meet 
the required criteria should appear first. Consider only ‘COMPLETE’ and ‘CLOSED’ orders and those belonging to 
the customer segment: ‘Consumer’. The final output should contain the following columns:
-Shipping_Mode,
-Shipping_Underestimated_Order_Count,
-Shipping_Mode_Rank

HINT: Use orders and customer_info tables from the Supply chain dataset.


*/
SELECT O.SHIPPING_MODE as Shipping_Mode, count(O.ORDER_ID) AS Shipping_Underestimated_Order_Count,RANK() OVER (PARTITION BY YEAR(O.ORDER_DATE) ORDER BY COUNT(O.ORDER_ID) desc) as Shipping_Mode_Rank
FROM ORDERS O
LEFT JOIN CUSTOMER_INFO C
ON O.CUSTOMER_ID=C.ID
WHERE O.Scheduled_Shipping_Days<O.Real_Shipping_Days AND (O.ORDER_STATUS='COMPLETE' OR O.ORDER_STATUS='CLOSED') AND C.SEGMENT='Consumer'
GROUP BY YEAR(O.ORDER_DATE),O.SHIPPING_MODE
ORDER BY YEAR(O.ORDER_DATE),Shipping_Underestimated_Order_Count DESC;
-- **********************************************************************************************************************************





