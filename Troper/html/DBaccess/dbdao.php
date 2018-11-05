<?php
class DAO{
  private function dbaccess($sql,$cute){
    try{
      $pdo = new PDO('mysql:host=localhost;dbname=reportDB;charset=utf8mb4','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      $stmt = $pdo->prepare($sql);
      $stmt->execute($cute);
      $ret = '';
      if(preg_match('/SELECT/',$sql)){
        $ret = $stmt->fetchall();
      }
    } catch (PDOException $e) {
      $errorMessage = 'データベースエラー';
      $e->getMessage();
      echo $e->getMessage();
    } finally {
      $pdo = '';
      $stmt = '';
      return $ret;
    }
  }

  public function login($userid,$password){
    $sql = 'SELECT * FROM user WHERE userID = ?';
    $cute = array($userid);
    $row = $this->dbaccess($sql,$cute);
    if(!empty($row)){
      $user = $row[0];
      if ($password == $user['password'] && $userid == $user['userID']) {
          session_regenerate_id(true);
          if($user['view'] != '0'){
            $_SESSION['name'] = $user['username'];
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['permission'] = $user['permissionID'];
            $_SESSION['selectcon'] = 'content';
            $_SESSION['count'] = 100;
          } else {
            return 'お使いのアカウントは使用できません';
          }
      } else {
          return 'ユーザーIDあるいはパスワードに誤りがあります';
      }
    } else {
      return 'ユーザーIDあるいはパスワードに誤りがあります';
    }
  }

  public function content($id,$select){
    if($select == 'content' || $select == 'userlist'){
      $sql = 'SELECT report.reportID,report.timedate,report.today,report.tommorow,
                     report.problem,report.good,report.fatigue,
                     report.motivation,user.username
              FROM report
              INNER JOIN user ON report.userID = user.userID
              WHERE report.userID = :userID
              ORDER BY report.timedate DESC';
      $cute = array('userID' => $id);
    }else if($select == 'allcontent'){
      $sql = 'SELECT report.reportID,report.timedate,report.today,report.tommorow,
                     report.problem,report.good,report.fatigue,
                     report.motivation,user.username
              FROM report
              INNER JOIN user ON report.userID = user.userID
              WHERE view = true
              ORDER BY report.timedate DESC';
      $cute = null;
    }else if($select == 'grouplist'){
      $sql = 'SELECT report.reportID,report.timedate,report.today,report.tommorow,
                     report.problem,report.good,report.fatigue,
                     report.motivation,user.username,teammember.teamID
              FROM ((teammember INNER JOIN report ON teammember.userID = report.userID)
              INNER JOIN user ON report.userID = user.userID)
              WHERE teammember.teamID = :teamID AND view = true
              ORDER BY report.timedate DESC';
      $cute = array(':teamID' => $id);
    }
  return $this->dbaccess($sql,$cute);
  }

  public function userall($userID){
    if($_SESSION['permission'] == '0'){
      $sql = 'SELECT userID,username,view FROM user WHERE userID NOT LIKE :userID ORDER BY username';
      $cute = array(':userID' => $userID);
    } else {
      $sql = 'SELECT userID,username FROM user WHERE view = true AND userID NOT LIKE :userID AND username NOT LIKE "admin" ORDER BY username';
      $cute = array(':userID' => $userID);
    }
    return $this->dbaccess($sql,$cute);
  }

  public function groupall(){
    $sql = 'SELECT teamID,teamname FROM team ORDER BY teamname';
    $count = 0;
    return $this->dbaccess($sql,null);
  }

  public function createreport($daialy){
    $sql = 'INSERT INTO report (userID,timedate,today,tommorow,problem,good,fatigue,motivation)
                  VALUES (:userID, :timedate, :today, :tommorow, :problem, :good, :fatigue, :motivation)';
    $ret = $this->dbaccess($sql,$daialy);
  }

  public function groupretrieval($userid){
    $sql = 'SELECT team.teamname
            FROM teammember
            INNER JOIN team ON teammember.teamID = team.teamID
            WHERE userID = :userID
            ORDER BY team.teamname';
     $cute = array('userID' => $userid);
    return $this->dbaccess($sql,$cute);
  }

  public function newpassword($userid,$oldpassword,$newpassword){
    $sql = 'SELECT * FROM user WHERE userID = :userID';
    $cute = array('userID' => $userid);
    $row = $this->dbaccess($sql,$cute,'SELECT');
    $user = $row[0];
    $error = '';
    if($user['password'] == $oldpassword){
      $sql = 'UPDATE user SET password = :password WHERE userID = :userid';
      $cute = array(':password' => $newpassword, ':userid' => $userid);
      $row = $this->dbaccess($sql,$cute);
    } else {
      $error = 'パスワードが一致しません';
    }
    return $error;
  }

  public function newname($userid,$username){
    $sql = 'UPDATE user SET username = :username WHERE userID = :userID';
    $cute = array(':username' => $username,':userID' => $userid);
    $row = $this->dbaccess($sql,$cute);
  }

  public function usersearch($userid){
    $sql = 'SELECT username FROM user
            WHERE userID = :userID';
    $cute = array(':userID' => $userid);
    $row = $this->dbaccess($sql,$cute);
    $row = $row[0];
    return $row['username'];
  }

  public function teamsearch($teamid){
    $sql = 'SELECT teamname FROM team
            WHERE teamID = :teamID';
    $cute = array(':teamID' => $teamid);
    $row = $this->dbaccess($sql,$cute);
    $row = $row[0];
    return $row['teamname'];
  }

  public function userentry($user){
    $sql = 'INSERT INTO user (userid,username,password,view) VALUES (:userID,:username,:password,1)';
    $ret = $this->dbaccess($sql,$user);
  }

  //グループを新しく登録する
  public function groupentry($groupname){
    $sql = 'INSERT INTO team (teamname) VALUE (:groupname)';
    $cute = array(':groupname' => $groupname);
    $ret = $this->dbaccess($sql,$cute);
  }

  //グループメンバーを追加する
  public function groupmemberadd($groupid,$userid){
    $sql = 'INSERT INTO teammember (teamID,userID) VALUES (:teamID,:userID)';
    $cute = array(':teamID'=>$groupid,':userID'=>$userid);
    $ret = $this->dbaccess($sql,$cute);
  }

  //グループ名からグループIDを取得
  public function getgroupid($groupname){
    $sql = 'SELECT teamid FROM team WHERE teamname = ?';
    $cute = array($groupname);
    $groupid = $this->dbaccess($sql,$cute);
    return $groupid;
  }

  //グループIDからグループ名を取得
  public function getgroupname($groupID){
    $sql = 'SELECT teamname FROM team WHERE teamid = ?';
    $cute = array($groupID);
    return $this->dbaccess($sql,$cute);
  }

  //ユーザーIDの被りチェック　被りがなければtrueを返す
  public function checkuserid($userid){
    $sql = 'SELECT * FROM user WHERE NOT EXISTS (SELECT * FROM user WHERE userid = ?)';
    $cute = array($userid);
    $ret = $this ->dbaccess($sql,$cute);
    return $ret;
  }

  //グループIDの被りチェック　かぶりがなければtrueを返す
  public function checkgroupid($groupid){
    $sql = 'SELECT * FROM team WHERE NOT EXISTS (SELECT * FROM team WHERE teamid = ?)';
    $cute = array($groupid);
    $ret = $this->dbaccess($sql,$cute);
    return $ret;
  }

  //ユーザー名からユーザーIDを取得
  public function getuserid($username){
    $sql = 'SELECT userid FROM user WHERE username = ?';
    $cute = array($username);
    $userid = $this->dbaccess($sql,$cute);
    return $userid;
  }

  //グループに所属してるメンバーを取得
  public function getmemberlist($groupid){
    $sql = 'SELECT userid FROM teammember WHERE teamid = ?';
    $cute = array($groupid);
    return $this->dbaccess($sql,$cute);
  }

  public function groupmemberdelete($groupid,$userid){
    $sql = 'DELETE FROM teammember WHERE teamid = :teamid && userid = :userid';
    $cute = array(':teamid'=>$groupid,':userid'=>$userid);
    return $this->dbaccess($sql,$cute);
  }

  public function groupdelete($groupid){
    $sql = 'DELETE FROM teammember WHERE teamid = :groupid';
    $cute = array(':groupid'=>$groupid);
    $ret=$this->dbaccess($sql,$cute);
    $sql = 'DELETE FROM team WHERE teamid = :groupid';
    return $this->dbaccess($sql,$cute);
  }

  public function getreport($reportID){
    $sql = 'SELECT timedate,today,tommorow,problem,
                   good,fatigue,motivation
            FROM report WHERE reportID = ?';
    $cute = array($reportID);
    return $this->dbaccess($sql,$cute);
  }

  public function editreport($newdialy){
    $sql = 'UPDATE report SET today = :today,tommorow = :tommorow,
                              problem = :problem,good = :good,fatigue = :fatigue,motivation = :motivation
            WHERE reportID = :reportID';
    return $this ->dbaccess($sql,$newdialy);
  }

  public function deletereport($reportID){
    $sql = 'DELETE FROM comment WHERE reportID = :reportID';
    $cute = array(':reportID' => $reportID);
    $this->dbaccess($sql,$cute);

    $sql = 'DELETE FROM report WHERE reportID = :reportID';
    return $this ->dbaccess($sql,$cute);
  }

  public function newgroupname($groupID,$newname){
    $sql = 'UPDATE team SET teamname = :teamname WHERE teamID = :teamID';
    $cute = array(':teamname'=>$newname, ':teamID'=>$groupID);
    return $this->dbaccess($sql,$cute);
  }

  public function getusername($userID){
    $sql = 'SELECT username FROM user WHERE userID = :userID';
    $cute = array(':userID'=> $userID);
    $row = $this->dbaccess($sql,$cute);
    $row = $row[0];
    return $row;
  }

  public function newuserID($oldID,$newID){
    $error = '';
    $sql = 'SELECT * FROM user WHERE NOT EXISTS (SELECT * FROM user WHERE userID = :newID)';
    $cute = array(':newID'=>$newID);
    if($this->dbaccess($sql,$cute)){
      $sql = 'UPDATE user SET userID = :newID WHERE userID = :oldID';
      $cute = array(':oldID'=>$oldID, ':newID'=>$newID);
      $row = $this->dbaccess($sql,$cute);
    }else {
      $error = 'このIDは既に使われています';
    }
    return $error;
  }

  public function resetpassword($userid,$password){
    $sql = 'UPDATE user SET password = :password WHERE userID = :userid';
    $cute = array(':password' => $password, ':userid' => $userid);
    $row = $this->dbaccess($sql,$cute);
  }

  public function changeview($userid){
    $sql = 'SELECT view FROM user WHERE userID = :userID';
    $cute = array(':userID' => $userid);
    $row = $this->dbaccess($sql,$cute);
    $view = $row[0];
    if($view['view'] == 0){
      $sql = 'UPDATE user SET view = 1 WHERE userID = :userID';
      $row = $this->dbaccess($sql,$cute);
    } else if ($view['view'] == 1){
      $sql = 'UPDATE user SET view = 0 WHERE userID = :userID';
      $row = $this->dbaccess($sql,$cute);
    }
  }

  public function getmygroup($userID){
    $sql = 'SELECT teamID FROM teammember WHERE userID = :userID';
    $cute = array(':userID'=>$userID);
    return $this ->dbaccess($sql,$cute);
  }

  public function checkgroup($teamname){
    $sql = 'SELECT * FROM team WHERE EXISTS (SELECT * FROM team WHERE teamname = :teamname)';
    $cute = array(':teamname' => $teamname);
    return $this->dbaccess($sql,$cute);
  }

  public function checkmygroupname($teamname,$reteamname){
    $sql = 'SELECT teamname FROM team WHERE teamname != :teamname';
    $cute = array(':teamname' => $teamname);
    $row = $this->dbaccess($sql,$cute);
    foreach ($row as $key => $value) {
      if($value['teamname'] == $reteamname){
        return true;
      }
    }
    return false;
  }

  public function commentcreate($comment){
    $sql = 'INSERT INTO comment (timedata,comment,userID,reportID)
                  VALUES (:timedata, :comment, :userID, :reportID)';
    return $this->dbaccess($sql,$comment);
  }

  public function commentcheck($reportID){
    $sql='SELECT comment.timedata,comment.comment,comment.reportID,user.username
          FROM comment
          INNER JOIN user ON comment.userID = user.userID
          WHERE reportID = :reportID';
    $cute = array(':reportID' => $reportID);
    return $this->dbaccess($sql,$cute);
  }



}
?>
