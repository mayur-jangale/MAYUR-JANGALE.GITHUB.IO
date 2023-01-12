use supply_db ;

/*
Question : Golf related products

List all products in categories related to golf. Display the Product_Id, Product_Name in the output. Sort the output in the order of product id.
Hint: You can identify a Golf category by the name of the category that contains golf.

*/
select product_id, product_name from product_info
left join category on product_info.category_id= category.Id
where category.name like "%Golf%"
order by product_id 
-- **********************************************************************************************************************************

/*
Question : Most sold golf products

Find the top 10 most sold products (based on sales) in categories related to golf. Display the Product_Name and Sales column in the output. Sort the output in the descending order of sales.
Hint: You can identify a Golf category by the name of the category that contains golf.

HINT:
Use orders, ordered_items, product_info, and category tables from the Supply chain dataset.


*/
select product_name, sum(sales) as sales from product_info
left join ordered_items on item_id = product_id
left join category on category_id= category.Id
where category.name like "%Golf%"
group by product_name
order by sales DESC
limit 10

-- **********************************************************************************************************************************

/*
Question: Segment wise orders

Find the number of orders by each customer segment for orders. Sort the result from the highest to the lowest 
number of orders.The output table should have the following information:
-Customer_segment
-Orders


*/
select segment as Customer_segment, count(order_id) as Orders from customer_info 
left join orders on orders.customer_id = customer_info.Id
group by Customer_segment
order by order desc;




-- **********************************************************************************************************************************
/*
Question : Percentage of order split

Description: Find the percentage of split of orders by each customer segment for orders that took six days 
to ship (based on Real_Shipping_Days). Sort the result from the highest to the lowest percentage of split orders,
rounding off to one decimal place. The output table should have the following information:
-Customer_segment
-Percentage_order_split

HINT:
Use the orders and customer_info tables from the Supply chain dataset.


*/
select segment as Customer_segment, ROUND(count(order_id)*100/(select count(1) from orders where Real_Shipping_Days = 6 ),1)  as Percentage_order_split from customer_info 
left join orders on orders.customer_id = customer_info.Id
where Real_Shipping_Days = 6
group by Customer_segment
order by Percentage_order_split desc;



-- **********************************************************************************************************************************
