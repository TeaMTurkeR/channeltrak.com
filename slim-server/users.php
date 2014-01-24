<?php 

function getUsers() {
	$sql = 'SELECT * FROM users ORDER BY id';
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"users": ' . json_encode($users) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getUser($id) {
    $sql = 'SELECT * FROM users WHERE id=:id';
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $user = $stmt->fetchObject();  
        $db = null;
        echo json_encode($user); 
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function createUser() {
    error_log('AddUser\n', 3, '/var/tmp/php.log');
    $request = \Slim\Slim::getInstance()->request();
    $user = json_decode($request->getBody());
    $sql = 'INSERT INTO users (name, email, password, created, updated) VALUES (:name, :email, :password, :created, :updated)';
    try {

        $name = $user->name;
        $email = $user->email;
        $password = md5($user->password);
        $current_date = date('Y-m-d H:i:s');

        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam('name', $name);
        $stmt->bindParam('email', $email);
        $stmt->bindParam('password', $password);
        $stmt->bindParam('created', $current_date);
        $stmt->bindParam('updated', $current_date);
        $stmt->execute();

        $user->id = $db->lastInsertId();
        $db = null;

        echo json_encode($user); 
    
    } catch(PDOException $e) {
        error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function loginUser() {

    $app->setCookie('foo', 'bar', '2 days');
    
}
