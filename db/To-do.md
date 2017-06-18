## To-dos 

### plz cross out all the files that alerady work with mongodb, and keep note for bugs and progress.  

## Useful Links

php_mongo documentation:https://docs.mongodb.com/php-library/master/reference/method/MongoDBCollection-findOne/

# !!NOTE!!:  
* Since generates its own _id field, we can use _id as specifier for list and challenge when modifying delete_list.php or delete_challenge.php. Take create list for example, when creating a list, I left "lid" as NULL. and when get list, give list_id the value of _id, and when delete list, use _id as the parameter to find the entry. Theoretically this will work. ------ weijian

* if you want to find a document with ObjectId, you need to do this: 

  ```php
  $result=$collection->findOne(["_id"=> new MongoDB\BSON\ObjectID('593daa1e1e3fc711a9000060')]);
  ```

  where '593daa1e1e3fc711a9000060' is the parameter of ObjectId() in mongoDB ——weijian 
* similar to the upper method, if u want to find a document with a pattern such as 'LIKE' query in SQL. use    new MongoDB\BSON\Regex() 

#FILEs

* ~~check_username.php~~
* ~~create_account.php~~
* ~~create_challenge.php~~
* ~~create_list.php~~
* ~~create_challenge.php~~
* ~~db_creds.php~~
* ~~db_init.php~~
* ~~delete_challenge.php~~
* ~~delete_list.php~~
* ~~determine_winner.php~~
* ~~do_login_old.php~~
  * old version for mysql
* ~~do_login.php~~
* ~~do_username_login.php~~
* email_hint.php
* fb_login.php
  * we were not using this one right?
* ~~get_capsule_info.php~~
* ~~get_dental_schools.php~~
* ~~get_do_schools.php~~
* get_drugs_old.php
* get_drugs.php
  * This would output a json encoded object of all drugs, still need to change code in js file so that it can handle the json code
* ~~get_lists.php~~
* ~~get_med_schools.php~~
* ~~get_notifications.php~~ (empty bug issue)
* ~~get_nursing_schools.php~~
* ~~get_pa_schools.php~~
* ~~get_pharm_schools.php~~
* ~~get_programs.php~~
* get_schools_list.php (do we still need this?)
* ~~get_schools.php~~
* ~~get_specific_list.php~~
* ~~get_specific_school_list.php~~
* ~~get_user_profile.php~~
* send_email_user2.php
* test.php
  * code used to test 
* ~~update_capsules.php~~
* ~~update_challenge_being_challenged.php~~
* ~~update_challenge_capsules.php~~
* ~~update_challenge_challenging.php~~
* ~~update_drug_dislikes.php~~
* ~~update_drug_likes.php~~
* ~~update_drugs.php~~
