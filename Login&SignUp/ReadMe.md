# Php Login&Signup_page
___

## index_page

while in  [Index_page](https://shorturl.at/DJ579) in this I'm checking whether user is old or new through checking session if session i already there i directly direct to Home_page 
**if session is not there**

I am displaying the form for login and loggout seperatly with input fields

where i have mysql connection config in [mysql_config](https://shorturl.at/wPQ49)

inserting the values to the database with query given below 

```sql
INSERT INTO login_cred (Name, Email, Password, Mobile) VALUES (?, ?, ?, ?);

```

## home page 

In [Home_page](https://shorturl.at/awDN1)

In this page where it displays "welcome message with <their "name"> and a anchor tag for logging out the session by navigating to [logout_page](https://shorturl.at/hotA4)
