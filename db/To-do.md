## To-dos 

### plz cross out all the files that alerady work with mongodb, and keep note for bugs and progress.  



# !!NOTE!!:  
####Since mongodb generates its own _id field, we can use _id as specifier for list and challenge when modifying delete_list.php or delete_challenge.php. Take create list for example, when creating a list, I left "lid" as NULL. and when get list, give list_id the value of _id, and when delete list, use _id as the parameter to find the entry. Theoretically this will work. ------ by weijian 



* ~~check_username.php~~
* ~~create_account.php~~
* ~~create_challenge.php~~
* create_list.php
* create_challenge.php
* ~~create_list.php~~
* ~~db_creds.php~~
* ~~db_init.php~~
* delete_challenge.php
* ~~delete_list.php~~
* determine_winner.php
* do_login_old.php
  * old version for mysql
* ~~do_login.php~~
* do_username_login.php
* email_hint.php
* fb_login.php
* get_capsule_info.php
* get_dental_schools.php
* get_do_schools.php
* get_drugs_old.php
* get_drugs.php
  * This would output a json encoded object of all drugs, still need to change code in js file so that it can handle the json code
* get_lists.php
* get_med_schools.php
* get_notifications.php
* get_nursing_schools.php
* get_pa_schools.php
* get_pharm_schools.php
* get_programs.php
* get_schools_list.php
* get_schools.php
* get_specific_list.php
* get_specific_school_list.php
* get_user_profile.php
* send_email_user2.php
* test.php
  * code used to test 
* update_capsules.php
* update_challenge_being_challenged.php
* update_challenge_capsules.php
* update_challenge_challenging.php
* update_drug_dislikes.php
* update_drug_likes.php
* update_drugs.php