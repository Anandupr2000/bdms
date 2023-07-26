INSERT INTO donor_details(uid,donor_number,donor_age,donor_gender,donor_blood,donor_address,fees) VALUES 
(2,'9091358908',24,'male',4,'Ernakulam',0),
(3,'9901582965',23,'female',4,'Alappuzha',0),
(4,'9903998913',24,'male',1,'Wayanad',200),
(5,'941319558',24,'male',3,'Kannur',100),
(6,'9033315898',24,'male',4,'Pathanamthitta',0),
(7,'9088058900',24,'male',2,'Malappuram',0);

INSERT INTO users (uname,type,email,upass) VALUES 
("admin","admin",'',123),
("Adhvaidh Jayesh","user",'adhvaidhjayesh@gmail.com',123),
("Gowri",'user','gowri123@gmail.com',123),
("Manoj Kumar",'user','manojkumar@gmail.com',123),
("Sunil Kumar",'user','sunilkumar@gmail.com',123),
("Dhanesh Anand",'user','dhaneshanand@gmail.com',123),
("Sameer KT",'user','sameerkt@gmail.com',123);

INSERT INTO TABLE donor_details VALUES 
select * from donor_details join blood where donor_details.donor_blood=blood.blood_id AND donor_details.donor_address='Ernakulam' limit 5

INSERT INTO messages(senderuid,receiveruid) VALUES (2,3,"Hello"),(3,2,"Hai")

INSERT INTO medical_history (uid, gudHealth, bloodDonated, sickness, pregnancy, diabetic, std)
VALUES
  (2, 'Yes', 'No', 'No', 'No', 'No', 'No'),
  (3, 'Yes', 'No', 'No', 'No', 'No', 'No'),
  (4, 'Yes', 'No', 'No', 'No', 'No', 'No'),
  (5, 'Yes', 'No', 'No', 'No', 'No', 'No'),
  (6, 'Yes', 'No', 'No', 'No', 'No', 'No'),
  (7, 'Yes', 'No', 'No', 'No', 'No', 'No'),
  (17, 'Yes', 'No', 'No', 'No', 'No', 'No'),
  (18, 'Yes', 'No', 'No', 'No', 'No', 'No'),
  (23, 'Yes', 'No', 'No', 'No', 'No', 'No'),
  (24, 'Yes', 'No', 'No', 'No', 'No', 'No');
