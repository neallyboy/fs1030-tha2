# FS1030-Take Home Assignment #2


## Question #1

1. Create Database by opening the terminal<br><br>
`mysqladmin -u root -p create book_db`<br><br>
2. Restore the backup to the newly created database. Give the path where the dump exists<br><br>
`mysql -u root -p book_db < ~/Q1/book_db.sql`<br><br>

### ER Diagram #1
![](/Q1/images/er_diagram.gif)

## Question #2

**Tested with:** VS Code Extension PHP Server

1. Create Database by opening the terminal<br><br>
`mysqladmin -u root -p create support_db`<br><br>
2. Restore the backup to the newly created database. Give the path where the dump exists<br><br>
`mysql -u root -p support_db < ~/Q1/support_db.sql`<br><br>
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

### ER Diagram #2
![](/Q2/images/er_diagram.gif)