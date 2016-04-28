# Compute Time PHP Class


**AUTHOR** 			: *Reyan Celestial Tropia* 
**Interface Name** 	: *TIME* 
**Class Name** 		: *ComputeTime* 

#####NOTES

	MINUTES MUST BE DECLARE WITH 0 IF LESS THAN 10
	E.G 01 02 03 04
	DONT USE MINUTES LIKE 8:1 AM

######PHP Syntax
```php
$x = new ComputeTime(); //Initialize the Class

$x->setSchedule(array("8:00 AM" , "12:00 PM" , "1:00 PM" , "5:00 PM")); // Set the work schedule(OPTIONAL)

$x->timeDiff("1:00 PM" , "1:59 PM") ; //Compute the difference of two time(break is deducted base on schedule)
```

##Displaying/Fetching Data
```php
echo $x->time(); // get the full time difference
echo $x->getHour(); //get the difference in Hours format.
echo $x->getMinute(); //get the difference in minutes format.
```