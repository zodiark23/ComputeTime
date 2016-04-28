#Compute Time


**AUTHOR** 			: *Reyan Celestial Tropia*

**Interface Name** 	: *TIME*

**Class Name** 		: *ComputeTime*

#####(NOTE)

	MINUTES MUST BE DECLARE WITH 0 IF LESS THAN 10
	E.G 01 02 03 04
	DONT USE MINUTES LIKE 8:1 AM

>$x = new ComputeTime(); //Initialize the Class

>$x->setSchedule(array($AMIn , "12:01 PM" , "1:00 PM" , "5:00 PM")); // Set the work schedule(OPTIONAL)

>$x->timeDiff("1:00 PM" , "1:59 PM") ; //Compute the difference of two time(break is deducted base on schedule)

```html
   // code for coloring lol
```

##Displaying/Fetching Data
> echo $x->time(); // get the full time difference
> echo $x->getHour(); //get the difference in Hours format.
> echo $x->getMinute(); //get the difference in minutes format.
