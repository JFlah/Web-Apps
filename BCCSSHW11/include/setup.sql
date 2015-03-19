// Make the table

create table myclub(
	name varchar(20),
        email varchar(40),
        password char(40),
        registration_date datetime,
        membership_type enum('Peasant', 'Hacker', 'Turing')
        );
        
// insert people into table

insert into myclub(
	name,
        email,
        password,
        registration_date,
        membership_type) values ('Jack Flaherty', 'oconnonx@bc.edu', sha1('123456'), now(), 'Turing');
        
insert into myclub(
	name,
        email,
        password,
        registration_date,
        membership_type) values ('Kevin Gleason', 'kevin.gleason@bc.edu', sha1('ilovekevinOS'), now(), 'Hacker');
        
insert into myclub(
	name,
        email,
        password,
        registration_date,
        membership_type) values ('Andrew Francl', 'francl@bc.edu', sha1('bionerd'), now(), 'Peasant');
        
// show all about a member with a particular email address

SELECT * from myclub where email='oconnonx@bc.edu';

// update member info

update myclub set password=sha1('hello') where name='Jack Flaherty';

// delete a member

delete from myclub where name='Andrew Francl';