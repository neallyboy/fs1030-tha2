# FS1030-Take Home Assignment #2


## Question #1
The SQL statements I wrote are in the **Q1** folder, **tha_2_q1.sql** file . The statements are in no particular as this was used more like a notebook.

I also included the data dump from MySQL located in the **Q1** folder, **book_db.sql** for a more cleaner structure.

Use the below to create the book_db if so inclined.

1. Create Database by opening the terminal<br><br>
`mysqladmin -u root -p create book_db`<br><br>
2. Restore the backup to the newly created database. Give the path where the dump exists<br><br>
`mysql -u root -p book_db < ~/fs1030-tha2/Q1/book_db.sql`<br><br>

### ER Diagram #1
![](/Q1/images/er_diagram.gif)

## Question #2
The SQL statements I wrote are in the **Q2** folder, **tha_2_q2.sql** file . The sstatements are in no particular as this was used more like a notebook.

I also included the data dump from MySQL located in the **Q2** folder, **support_db.sql** for a more cleaner structure.

**Tested with:** VS Code Extension PHP Server

1. Create Database by opening the terminal<br><br>
`mysqladmin -u root -p create support_db`<br><br>
2. Restore the backup to the newly created database. Give the path where the dump exists<br><br>
`mysql -u root -p support_db < ~/fs1030-tha2/Q1/support_db.sql`<br><br>
3. In VS Code, load the login.php file by right clicking and selecting **PHP Server: Serve Project**<br><br>
![](/Q2/images/phpserveproject.png)<br><br>
4. The browser should load the login screen<br><br>
![](/Q2/images/phplogin.png)<br><br>
5. There are 2 test accounts with service tickets already created. Feel free to create mutiple accounts
```
-- Test User 1
UN: fs1030
PW: fs1030

-- Test User 2
UN: fs1040
PW: fs1040
```
**Assumptions:** In the View Open Tickets page, the logged in users can still view or delete the Closed ticket. If the ticket is closed, then the issue is resolved. The update ticket only exists for Open tickets.

### ER Diagram #2
![](/Q2/images/er_diagram.gif)