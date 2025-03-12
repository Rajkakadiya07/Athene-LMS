*attendance table need to configure in case of more than one lecture of same course on same day.
*student_quiz_score, question_answers understanding of primary key.

create table admin
( 
   adm_id varchar(15) primary key,
   adm_name varchar(50) not null,
   adm_contact_no char(10) not null,
   adm_email varchar(55) not null,
   adm_password varchar(30) not null
);

create table pending_requests
(
    usr_id varchar(15) primary key,
    usr_name varchar(50) not null,
    usr_contact_no char(10),
    usr_gender char(1) not null,
    usr_email varchar(55) not null,
    usr_password varchar(30) not null,
    usr_type varchar(10),
    usr_stud_category varchar(10)
);


create table category
(
   cat_id varchar(10) primary key,
   cat_short_name varchar(20),
   cat_full_name varchar(100) not null
);


create table course
( 
   cse_code varchar(10) primary key,
   cse_full_name varchar(100) not null,
   cse_short_name varchar(10),
   cse_desc varchar(1000),
   cse_start_date date not null,
   cse_end_date date,
   cse_semester int not null,
   cse_image varchar(200),
   cat_id varchar(10),
   foreign key (cat_id) references category(cat_id) on delete cascade on update cascade
);


create table teacher
( 
   tchr_id varchar(15) primary key,
   tchr_name varchar(50) not null,
   tchr_contact_no char(10) not null,
   tchr_gender char(1) not null,
   tchr_email varchar(55) not null,
   tchr_password varchar(30) not null,
   tchr_suspend bool
);


create table student
( 
   stud_id varchar(15) primary key,
   stud_name varchar(50) not null,
   stud_contact_no char(10) not null,
   stud_gender char(1) not null,
   stud_email varchar(55) not null,
   stud_semester int not null,
   stud_password varchar(30) not null,
   stud_suspend bool
);

 
create table course_teacher
(
   cse_code varchar(10),
   tchr_id varchar(15),
   primary key (cse_code, tchr_id),
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade,
   foreign key (tchr_id) references teacher(tchr_id) on delete cascade on update cascade
);



create table course_student
(
   cse_code varchar(10),
   stud_id varchar(15),
   primary key (cse_code, stud_id),
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade,
   foreign key (stud_id) references student(stud_id) on delete cascade on update cascade
);

create table attendance
(
   cse_code varchar(10),
   att_date date,
   att_status boolean,
   stud_id varchar(15),
   primary key (cse_code, stud_id, att_date),
   foreign key (stud_id) references student(stud_id) on delete cascade on update cascade,
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade
);


create table learning_material
(
   lm_id int,
   lm_type varchar(10) not null,
   lm_desc varchar(1000),
   lm_upload_date_time datetime not null,
   lm_content varchar(200),
   cse_code varchar(10),
   primary key (lm_id, cse_code),
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade 
);


create table quiz
(
   qui_no int,
   qui_name varchar(100),
   qui_desc varchar(1000),
   qui_total_marks int not null,
   qui_start_time datetime,
   qui_end_time datetime,
   cse_code varchar(10),
   primary key (qui_no, cse_code),
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade
);


create table announcement
(
   ann_no int,
   ann_name varchar(100),
   ann_desc varchar(1000),s
   ann_start_time datetime,
   ann_end_time datetime,
   cse_code varchar(10),
   primary key (ann_no, cse_code),
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade
);


create table assignment
(
   agn_no int,
   agn_name varchar(100), 
   agn_desc varchar(1000),
   agn_total_marks int not null,
   agn_file varchar(200),
   agn_start_time datetime,
   agn_end_time datetime,
   agn_submitted_count int,
   cse_code varchar(10),
   primary key (agn_no, cse_code),
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade
);


create table assignment_marks
(
   agn_no int,	
   agn_obtained_marks int,
   agn_submission_date_time datetime,
   agn_submission_file varchar(200),
   cse_code varchar(10),
   stud_id varchar(15),
   primary key (agn_no, stud_id, cse_code),
   foreign key (agn_no) references assignment(agn_no) on delete cascade on update cascade,
   foreign key (stud_id) references student(stud_id) on delete cascade on update cascade,
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade
);



create table question
(
   ques_no int,
   ques_text varchar(200) not null,
   ques_marks int not null,	
   qui_no int,
   cse_code varchar(10),
   primary key (ques_no, qui_no, cse_code),
   foreign key (qui_no) references quiz(qui_no) on delete cascade on update cascade,
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade
);



create table survey
(
   sry_no int primary key,
   sry_question varchar(200) not null,
   sry_start_time datetime,
   sry_end_time datetime,
   cse_code varchar(10),
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade
);

create table survey_answers
(
   sry_no int,
   sry_answer varchar(100) not null,
   cse_code varchar(10),
   primary key (sry_no, cse_code),
   foreign key (sry_no) references survey(sry_no) on delete cascade on update cascade,
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade
);

create table student_survey_answers
(
   stud_id  varchar(15) not null,
   cse_code varchar(10) not null,
   sry_no int not null,
   sry_question varchar(200) not null,
   
);

create table question_answers
(
   ques_no int,
   ques_answer varchar(100) not null,
   ques_correctanswer boolean,
   qui_no int,
   cse_code varchar(10),
   primary key (ques_no, qui_no, cse_code),
   foreign key (qui_no) references quiz(qui_no) on delete cascade on update cascade,
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade 
); 


create table student_quiz_score
(
   stud_id varchar(15),
   ques_no int,
   qui_no int,
   cse_code varchar(10),
   attended_answer boolean,
   foreign key (ques_no) references question(ques_no) on delete cascade on update cascade,
   foreign key (qui_no) references quiz(qui_no) on delete cascade on update cascade,
   foreign key (stud_id) references student(stud_id) on delete cascade on update cascade,
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade
);


create table quiz_result
(	
   stud_id varchar(15),
   cse_code varchar(10),
   tot_marks int,
   obtn_marks int,
   obtn_grade char,
   result_date date
   primary key (stud_id, cse_code),
   foreign key (stud_id) references student(stud_id) on delete cascade on update cascade,
   foreign key (cse_code) references course(cse_code) on delete cascade on update cascade
);