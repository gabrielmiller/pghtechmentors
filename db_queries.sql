--1. insert user with 3 timeslots
-- ######  User registration  ########
-- 1. User entry
INSERT INTO `pghtechmentors`.`user` (`user_id`, `account_type`, `email_id`, `name_last`, `name_first`, `contact_home`, `contact_mobile`, `skill`, `is_available`, `zip_code`, `about_me`, `password`) VALUES 
(NULL, 'M', 'akshaybhaskar@gmail.com', 'bhaskarwar', 'akshay', NULL, '4124184439', 'Web Development', '1', '15217', 'I have 11 yrs of experience in the Web site development. I love to teach kids. My prev. exp is so and so. ', '12345');

-- 2. Get User id to insert into Timeslot:
Select user_id from user where email_id ='$mail';

-- 3. Timeslot entry:
INSERT INTO pghtechmentors.user_timeslot (user_id, day_id, timeslot_id) VALUES ('1', '1', '1');

-- ######  Edit Mentor Profile   ########
-- 1. Get User details
SELECT `user_id`, `email_id`, `name_last`, `name_first`, `contact_home`, `contact_mobile`, `skill`, `is_available`, `zip_code`, `about_me`
FROM
	USER
WHERE
	user_id = '$user' and
	account_type='M';

-- 2. Get Timeslots details, should give max 3 records
SELECT day_id, timeslot_id from pghtechmentors.user_timeslot where user_id='$user';

-- Update user
-- 3. Update User
UPDATE pghtechmentors.user set 
`name_last` = 'last11',
`name_first` = 'first11',
`contact_home` = '121211111',
`contact_mobile` = '121212111',
`skill` = 'web11',
`zip_code` = '15218',
`about_me` = 'about mecc',
password = ''-- if user enters password then it will be set else not.
WHERE user.user_id='$user';

-- 4. Delete and then Insert timeslots
DELETE FROM time_slot where user_id='$user';
INSERT INTO pghtechmentors.user_timeslot (user_id, day_id, timeslot_id) VALUES ('1', '1', '1');

-- ###### Search Mentors ####
--- Get users from Day and Timeslot in Search
SELECT `user_id`, `email_id`, `name_last`, `name_first`, `contact_home`, `contact_mobile`, `skill`, `is_available`, `zip_code`, `about_me`
FROM user where user_id in (
SELECT user_id FROM `user_timeslot` WHERE day_id=1 and timeslot_id=1);
