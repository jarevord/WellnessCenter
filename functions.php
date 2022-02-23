<?php
    //Testing for functions
    //$testing = array("Josh", "Revord", "A", "testing@test.com", "1234567890", "male", "123 Fake St", "Employee Semester", "12-31-2021");
    //$testing = array("WCadmin", "Rewritten", "3");
    //editUserPw($testing);

    function newPlan($planInfo){
        $handel = fopen("csv/plans.csv", "a");
        fputcsv($handel, $planInfo);

        fclose($handel);
    }

    function getPlanList(){
        $planList = [];
        $handel = fopen("csv/plans.csv", "r");

        while(! feof($handel)){
            $dataline = fgetcsv($handel);
            array_push($planList, $dataline);
        }
        fclose($handel);
        return $planList;
    }
    
    function getPlan($planName){
        $handel = fopen("csv/plans.csv", "r");

        while(! feof($handel))
        {
            $dataline = fgetcsv($handel);
            if($dataline[0] == $planName){
                fclose($handel);
                return $dataline;
            }
        }
        fclose($handel);
        $dataline = array(1,1,1,1,1,1,1,"No results");
        return $dataline;
    }
    function newMember($memberInfo){
        //$chosenplan = getPlan($memberInfo[7]);
        //$goodUntil = strtotime("+" . $chosenplan[1] . " days");
        $goodUntil = strtotime("Yesterday");
        $memberInfo[7] = $goodUntil;

        $memberID = strtotime("Now");
        $memberInfo[8] = $memberID;

        $handel = fopen("csv/members.csv", "a");
        fputcsv($handel, $memberInfo);

	    fclose($handel);
    }

    function getMemberList(){
        $memberList = [];
        $handel = fopen("csv/members.csv", "r");

        while(! feof($handel))
        {
            $dataline = fgetcsv($handel);
            array_push($memberList, $dataline);
        }

        fclose($handel);
        return $memberList;
    }

    function getMember($id){
        $handel = fopen("csv/members.csv", "r");

        while(! feof($handel))
        {
            $dataline = fgetcsv($handel);
            if($dataline[8] == $id){
                fclose($handel);
                return $dataline;
            }
        }
        fclose($handel);
        $dataline = array("");
        return $dataline;
    }
    function editMember($memberInfo){
        //passed array has member ID number in the 8th index and editable values in the rest
        $EMmemberlist = getMemberList();
        $handel = fopen("csv/members.csv", "w");
        foreach($EMmemberlist as $em)
        {
            if($em[8] == $memberInfo[8])    //If we find our member, edit the values
            {
                $em[0] = $memberInfo[0];
                $em[1] = $memberInfo[1];
                $em[2] = $memberInfo[2];
                $em[3] = $memberInfo[3];
                $em[4] = $memberInfo[4];
                $em[5] = $memberInfo[5];
                $em[6] = $memberInfo[6];
                $em[7] = $memberInfo[7];
                $em[9] = $memberInfo[9];
            }
            if($em[8] == "")
            {
                break;
            }
            fputcsv($handel, $em);
    
        }
        
        fclose($handel);
        
    }

    function deleteMember($memberInfo){
        //passed array has member ID number in the 8th index and editable values in the rest
        $DMmemberlist = getMemberList();
        $handel = fopen("csv/members.csv", "w");
        foreach($DMmemberlist as $dm)
        {
            if($dm[8] != $memberInfo)    //If we find our member, skip the values
            {
                if($dm[8] == "")
                {
                break;
                }
                fputcsv($handel, $dm);
            }
            if($dm[8] == "")
            {
                break;
            }
            
        }
        
        fclose($handel);
        
    }
    function newUser($userInfo){

        $handel = fopen("csv/users.csv", "a");
        fputcsv($handel, $userInfo);

        fclose($handel);
    }

    function getUser($un){
        $handel = fopen("csv/users.csv", "r");

        while(! feof($handel))
        {
            $dataline = fgetcsv($handel);
            if($dataline[0] == $un){
                fclose($handel);
                return $dataline;
            }
        }
        fclose($handel);
        $dataline = array("");
        return $dataline;
    }

    function getUserList(){
        $userList = [];
	    $handel = fopen("csv/users.csv", "r");

	    while(! feof($handel))
	    {
	        $dataline = fgetcsv($handel);
	    array_push($userList, $dataline);
	    }

	    fclose($handel);
        return $userList;
    }



    function newTransaction($transactionInfo){
        $handel = fopen("csv/transactions.csv", "a");
        $transactionDate = strtotime("now");

        array_push($transactionInfo, $transactionDate);
        fputcsv($handel, $transactionInfo);

        fclose($handel);
    }

    function getTransList(){
        $tranlist = [];
        $handel = fopen("csv/transactions.csv", "r");

        while(! feof($handel))
        {
            $dataline = fgetcsv($handel);
            array_push($tranlist, $dataline);
        }
        fclose($handel);
        return $tranlist;
    }
    
    function editUser($userInfo){
        //passed array has user name in first index, and new values for pw and role in the second and third
        $EUPuserlist = getUserList();
        $handel = fopen("csv/users.csv", "w");
        foreach($EUPuserlist as $eup)
        {
            if($eup[0] == $userInfo[0])
            {
                $eup[1] = $userInfo[1];
                $eup[2] = $userInfo[2];
            }
            if($eup[0] == "")
            {
                break;
            }
            if($eup[0] == "UserName"){
                $eup[1] = "Pass";
                $eup[2] = "Type";
            }
            fputcsv($handel, $eup);
    
        }
        
        fclose($handel);
        
    }

    function mbrCheckin($userInfo){
        $handel = fopen("csv/checkin.csv", "a");
        fputcsv($handel, $userInfo);
        fclose($handel);
    }

    function getCheckinList(){
        $ciList = [];
        $handel = fopen("csv/checkin.csv", "r");
        while(! feof($handel))
        {
            $dataline = fgetcsv($handel);
            array_push($ciList, $dataline);
        }
        fclose($handel);
        return $ciList;
    }

    function mbrCheckout($userInfo){
        $handel = fopen("csv/checkinHistory.csv", "a");
        fputcsv($handel, $userInfo);
        fclose($handel);

        $ciListupd = getCheckinList();
        $handel2 = fopen("csv/checkin.csv", "w");
        foreach($ciListupd as $cip)
        {
            if($cip[0] == $userInfo[0])
            {
                
            }
            else if($cip[0] == "")
            {
                break;
            }
            else{
               
                fputcsv($handel2, $cip);
            }
            
    
        }
        
        fclose($handel2);
    }

    function mbrHistory($userInfo){
        $handel = fopen("csv/checkinHistory.csv", "r");

        $mbrHistList = [];
        while(!feof($handel)){
            $dataline = fgetcsv($handel);
            if($dataline[0] == $userInfo[0] && $dataline[1] == $userInfo[1] && $dataline[2] == $userInfo[2])
            {
                array_push($mbrHistList, $dataline);
            }
        }

        fclose($handel);
        return $mbrHistList;
    }
?>