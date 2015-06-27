USE inquisitionContest;

ALTER TABLE participant AUTO_INCREMENT = 100;

insert into participant
(id
, name
, email
, major
, team)
VALUES
(NULL
, 'Marco Rosas'
, 'marco.rosas@outlook.com'
, 'CIT'
, (SELECT id from team where name='First Team'));

insert into participant
(id
, name
, email
, major
, team)
VALUES
(NULL
, 'Marco Rosas'
, 'marco.rosas@outlook.com'
, 'CIT'
, (SELECT id from team where name='First Team'));

insert into participant
(id
, name
, email
, major
, team)
VALUES
(NULL
, 'Marco Rosas'
, 'marco.rosas@outlook.com'
, 'CIT'
, (SELECT id from team where name='First Team'));

select * from participant;

delete from participant;

ALTER TABLE participant AUTO_INCREMENT = 1;
