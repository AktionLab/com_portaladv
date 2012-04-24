<?php
/* do not distribute this code without my consent 
* copyright (c) Craig Condon 2006
* craig@exoinverts.com
*/

	class SecureSQL{
		
		var $conn;
		
		var $query;//used for re iteration when waiting for a response
		var $values;//the values of the query
		
		var $error; //stores any regular expression errors or SQL errors
		var $data = array(); //data goes into here
		var $dataSize;

		var $validationPattern = array(
											'username' =>  array(
																 'reg' => '/^[\w\d\_\.]{4,}$/',
																 'msg' => 'The username speicified is invalid.'
																),
											'password' =>  array(
																 'reg' => '/^[\w\d\_\.]{4,}$/',
																 'msg' => 'The password speicifed is invalid.'
																),
											'email'    =>  array(
																 'reg' => '/^[\_]*([a-z0-9]+(\.|\_*)?)+@([a-z][a-z0-9\-]+(\.|\-*\.))+[a-z]{2,6}$/',
																 'msg' => 'The email specified is invalid.'
																),
											'phone'     =>  array(
																 'reg' => '/^\+?[\d\s]+\(?[\d\s]{10,}$/',
																 'msg' => 'The phone number specified is invalid.'
																),
											'bool'     =>  array(
																 'reg' => '/(0|1)/',
																 'msg' => 'The boolean value specified is invalid.'
																),
											'year'	   =>  array(
																 'reg' => '/^(19|20)[\d]{2,2}$/',
																 'msg' => 'The year specified is invalid.'
																),
											'domain'   =>  array(
																 'reg' => '/^([a-z][a-z0-9\-]+(\.|\-*\.))+[a-z]{2,6}$/',
																 'msg' => 'The URL speicifed is invalid.'
																),
											'text'	   =>  array(
																 'reg' => '/\w/',
																 'msg' => 'The text speicifed is invalid.'
																),
											'bit'	   =>  array(
																 'reg' => '/\w/',
																 'msg' => 'The bit speicifed is invalid.'
																),
											'integer'  =>  array(
																 'reg' => '/^\d*\.{0,1}\d+$/',
																 'msg' => 'The integer speicifed is invalid.'
																),
											'string'   =>  array(
																 'reg' => '/^[a-zA-Z]+$/',
																 'msg' => 'The string speicified is invalid.'
																)
										  );
		var $host;
		var $user;
		var $pass;
		var $database;

		

		
		function SecureSQL($host,$user,$pass,$database){
		 	$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->database = $database;
			$this->connect();
		}
		
		function connect(){
			$this->conn = mysql_connect($this->host, $this->user, $this->pass);
			if(mysql_error($this->conn)){
				$this->newError("Unable to connect to the database.");
			}else{
				$db = mysql_select_db($this->database,$this->conn);
				//check to see if there is a connection
				if(mysql_error($db)){
					$this->newError("Unable to connect to the database.");
				}
			}
		}
		
		///////////////////////////////////////////////////////////////////////////
		///////////////////////////QUERY EXECUTION/////////////////////////////////
		///////////////////////////////////////////////////////////////////////////
		
		//the method will help make the code smaller and easier to maintain
		//this method also 
		 function execute($query,$vals = array()){
			//restart data everything so past data isn't passed
			$this->data = array();

			$this->values = $vals;
			
			$queryType = $this->getQueryType($query);
				//now assign it to the appropriate method 
				switch($queryType){
					//each method assigns this->data a value
					case 'SELECT':
						$this->selectMethod($query);
					break;
					case 'INSERT':
						$this->insertMethod($query);
					break;
					case 'DELETE':
						$this->deleteMethod($query);
					break;
					case 'UPDATE':
						$this->updateMethod($query);
				break;
			}
			
			return $this->data;
		}
		 function getQueryType($query){
			//since the commands are separated by spaces, it's safe to try this method
			//this will make array(SELECT,*,FROM,`servers)
			$array = explode(" ",$query);
			//return the first command in the query
			return $array[0];
		}
		
		///////////////////////////////////methods/////////////////////////////////////////////////////////

		 function selectMethod($query){
			//if there are parameters to be filled, then add them
			if(count($this->values) > 0){
				$this->validate($this->values);
				$query .= ' WHERE '.$this->addCondition($this->values,'`:k` = \':v\'',' AND ');

			}
			//for debugging purposes
			$this->query = $query;
			//make sure that the validation above
			//does not return false. If all the values
			//are good then continue on
			
			if(!$this->error){
			
				//if there are no errors pass the conditional
				if($result = mysql_query($query,$this->conn)){
					$data = array();
					
					while($row = mysql_fetch_assoc($result))
						$data[] = $row;
					mysql_free_result($result);//free the data so there is no holes left in the code
					
					$this->data 	= $data;
					$this->dataSize = count($data);
				}else
					$this->newError("Unable to select data from the Database.".mysql_error());
			}
		}
		
		 function insertMethod($query){
		
			if(count($this->values) > 0){
				$this->validate($this->values);
				$query .= ' ('.$this->addCondition($this->values,'`:k`',',').') VALUES('.$this->addCondition($this->values,'\':v\'',',').')';
			}
			//this is for debugging purposes
			$this->query = $query;
			
			if(!$this->error){
				//if there are no errors pass the conditional
				if(!$result = mysql_query($query,$this->conn))
					$this->newError("Unable to insert data into the database.");
				else
					$this->newResult("Information sent to the database.");
			}
			
		}
		
		 function deleteMethod($query){
			//if there are parameters to be filled, then add them
			if(count($this->values) > 0){
				$this->validate($this->values);
				$query .= ' WHERE '.$this->addCondition($this->values,'`:k` = \':v\'',' AND ');

			}
			//for debugging purposes
			$this->query = $query;
			//make sure that the validation above
			//does not return false. If all the values
			//are good then continue on
			//this is for debugging purposes
			$this->query = $query;
			
			if(!$this->error){
				//if there are no errors pass the conditional
				if(!$result = mysql_query($query,$this->conn))
					$this->newError("Unable to insert data into the database.");
				else
					$this->newResult("Information sent to the database.");
			}
		}
		
		///////////////////////////////INCOMPLETE
		function updateMethod($query){
			$result = mysql_query($query,$this->conn);

			
		}
		 /*function deleteMethod($query){
		
			if(count($this->values) > 0){
				$errors = $this->validate($values);
				$query .= ' ('.$this->addCondition($this->values,'`k`',',').') VALUES('.$this->addCondition($this->values,'\'v\'',',').')';
			}
			
			if(!$this->error){
				//if there are no errors pass the conditional
				if($result = $this->conn->query($query))
					$this->data = true;
				else
					$this->error = mysql_error();
			}else
				return $errors;
			
		}*/
		
		//used for INSERT, DELETE, and UPDATE
		 function universalMethod($query){
			if($result = mysql_query($query,$this->conn))
				$this->data = true;
			else
				$this->newError("Unable to load data from the Database.");
		}
		
		
		//////////////////////////////////////helpers////////////////////////////////////////////////////
		
		//this method is used explicitly for the SELECT method, 
		//it's used for loops waiting a request so that it makes the
		//browser waiting until it returns true
		
		 function retryQuery(){
			$this->selectMethod($this->query);
			//send TRUE if there is data, FALSE if there isn't
			return (count($this->data) > 0);
		}
		//this allows multiple values to be added to a query, saving space
		//the use goes as follows
		 function addCondition($stack,$equation,$spacer){
		
				$part = "";
				$end = 0;
				foreach($stack as $k => $v){
					$end++;
					$k = $this->defineTables($k);
					//this will replace the KEYS and the VALUES of the custom method 
					$newEquation = preg_replace(array('/:k/','/:v/'),array($k,$v),$equation);
					//add the equation to it now
					$part .= $newEquation;
					//make sure that AND isn't at the end of the query string
					if($end != count($stack))
						$part .= $spacer;
					
				}
				
				return $part;
				
		}
		//this is used for the query, the table name is specified like so
		// data_username and it can be combined with string types
		// data_username-string or data-string_username
		 function defineTables($string){
			$table = explode('_',$string);
			//be sure that hyphens are out of the way
			$string = explode('-',$table[0]);
			//it's considered an error, but it's minor, make sure not to split an array that doesn't exist, get the last key
			$table[count($table)-1] = explode('-',$table[count($table)-1]);
			
			if(count($table) > 1)//returns the type if - is found
				return $table[1][0];
			else
				return $string[0];
				
		}
		//sometimes the type isn't the key
		//by doing this I can have a unique name and
		//a type at the same time like so data-string
		 function defineType($string){
			//defined types are separated by hyphens
			$split = explode('-',$string);
			//be sure that underscores are out of the way
			//gets rid of the underscore if it's the first part
			$string = explode('_',$split[0]);
			//it's considered an error, but it's minor, make sure not to split an array that doesn't exist, get the last key
			$split[count($split)-1] = explode('_',$split[count($split)-1]);
			
			if(count($split) > 1)//returns the type if - is found
				return $split[1][0];
			else
				//since exploding the data no matter what the case, throws the string into an array
				//return string[0] is needed
				return $string[0];
				
		}
		///////////////////////////////////////////////////////////////////////////
		////////////////////////////////SECURITY///////////////////////////////////
		///////////////////////////////////////////////////////////////////////////
		
		//the validate method takes in however many items there are to be validated and checks them
		 function validate($values){
			//using the array_walk method should increase runtime
			array_walk($values,array($this,'checkData'));
		}
		
		
		 function checkData(&$value,$key){
			//the expression is in the key so extract it by defineType
			$key = $this->defineType($key);
			//make sure the key exists so it doesn't cause an error
			if(array_key_exists($key,$this->validationPattern)){
				//the key is the key of the validation pattern so get the regex pattern for it
				if(!preg_match($this->validationPattern[$key]["reg"],$value))
						//if there is an error, flag it, store it then continue
						$this->newError($this->validationPattern[$key]["msg"]);
			}else{
				//if the key does NOT exist, then treat it as if it were text, anything really
				if(!preg_match($this->validationPattern["text"]["reg"],$value))
					$this->newError($this->validationPattern["text"]["msg"]);
			}
			//$value = htmlspecialchars(mysql_escape_string($value));
		}
		
		

		//if critical error is set false, then the code will keep executing
		 function newError($error,$critical = true){
			//flag the script if there is an error
			$this->error = $critical;
			//data IS an array so push the error message in it
			array_push($this->data,$error);
		}
		//this is intended for INSERT, UPDATE, and DELETE methods
		 function newResult($message){
			array_push($this->data,$message);
		}
		 function echoErrors(){
			return implode("\n",$this->data);
		}
		//this is the last to execute but it's dont right after the object is called
		 function close(){
			//make sure that a connection has been established before closing
			if(!mysqli_connect_errno())
				//close the connection so there are no leaks
				mysql_close($this->conn);
		}
		
		function get_mysql_result(){
			return $this->data;
		}
		function get_mysql_result_size(){
			return $this->dataSize;
		}
	}
?>