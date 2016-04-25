--Easy

SELECT name , age , FROM Player WHERE age>32 and nationality='Indian';


SELECT name , domain , FROM Coach WHERE domain='Head' ;


SELECT v.name FROM Venue v , Team t WHERE v.name=t.name ;


SELECT name FROM Umpire WHERE nationality='England' and experience>=50 ;


SELECT p.name FROM Player p , Team t , Plays x WHERE x.t_id=t.t_id and x.p_id=p.p_id and t.name='Chennai Super Kings' and x.year=2014;


SELECT * FROM Captain c , Team t , Player p WHERE c.p_id=p.p_id and c.t_id=t.t_id and c.year=2014 ;


SELECT p.name FROM Player p , P_award paw WHERE p.p_id=paw.p_id and p.nationality='Australian' ;


SELECT m_id , stage , m_date FROM Match WHERE toss_won_by=result ;




-- Medium level

--Runner up - can be used for all teams I have used MI as example
SELECT t.name , count(ta.t_id) FROM T_award ta, Team t WHERE t.t_id=ta.t_id and ta.name='IPL Runner Up' and t.name='Mumbai Indians';

--Winner - can be used for all teams I have used MI as example
SELECT t.name , count(ta.t_id) FROM T_award ta, Team t WHERE t.t_id=ta.t_id and ta.name='IPL Winner' and t.name='Mumbai Indians';

--Number of times captain for a team - include this in the player info for all the players we are creating links
SELECT p.name , c.year , count(c.p_id) FROM Captain c , Player p , Team t WHERE c.p_id=p.p_id and t.t_id=c.t_id GROUP BY t.name ;

--Number of times captains have won awards - can include it in the awards page
SELECT count(P_award.pa_id) FROM P_award INNER JOIN captains ON captains.p_id=P_award.p_id and captains.year=P_award.year;

--Average wickets by Malinga in Semi Finals - include in MAlinga's page
SELECT avg(ps.wickets) FROM Player_stats ps , C_Match m , Player p WHERE m.m_id=ps.m_id and m.stage='Semi Final' and ps.p_id=p.p_id and p.name='Lasith Malinga' ;

--Average Runs by Kohli/Warner in Group - include in respective players page
SELECT avg(ps.runs) FROM Player_stats ps , C_Match m , Player p WHERE m.m_id=ps.m_id and m.stage='Group' and ps.p_id=p.p_id and p.name='Virat Kohli' ;

--Average Age of a team - dummy value as all players have not been inserted into plays can be used on team page
-- Used for 2013 RCB
SELECT avg(p.age) FROM Player p , Team t , Plays py WHERE p.p_id=py.p_id and t.t_id=py.t_id and year=2013 and t.name='Royal Challengers Bangalore';


--Complex

--Average runs scored by Virat Kohli when he has won a match for the team he has played
SELECT avg(ps.runs) , avg(ps.strike_rate) FROM Player_stats ps WHERE ps.m_id IN (SELECT m.m_id FROM C_Match m , Team t WHERE m.result=t.t_id and t.name IN (SELECT t.name FROM Team t , Plays py , Player pl WHERE t.t_id=py.t_id and pl.p_id=py.p_id and pl.name='Virat Kohli'));

--Average stats of shane watson at home games
SELECT avg(ps.runs) , avg(ps.strike_rate) , count(wickets) FROM Player_stats ps WHERE ps.m_id IN (SELECT m.m_id FROM C_Match m , Team t , Venue v WHERE v.name=t.home_ground and t.name IN (SELECT t.name FROM Team t , Plays py , Player pl WHERE t.t_id=py.t_id and pl.p_id=py.p_id and pl.name='Shane Watson'));

--Number of matches won by a team at home
SELECT count(m.m_id) FROM C_Match m , Team t , Venue v WHERE t.t_id=m.result and v.v_id IN(SELECT v1.v_id FROM Venue v1 , Team t1 WHERE t1.home_ground=v1.name and t1.name='Sunrisers Hyderabad');

