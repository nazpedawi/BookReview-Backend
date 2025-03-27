<?php
namespace App\Models;

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($user)
    {
        $hashedPassword = password_hash($user["password"], PASSWORD_DEFAULT);

        $data = [
            "firstName" => $user["firstName"],
            "lastName" => $user["lastName"],
            "username" => $user["username"],
            "password" => $hashedPassword,
            "email" => $user["email"],
            "role" => $user["role"] ?? 'RegularUser'
        ];

        $query = "INSERT INTO Users (firstName, lastName, username, password, email, role)
                  VALUES (:firstName, :lastName, :username, :password, :email, :role)";
        $statement = self::$pdo->prepare($query);
        $statement->execute($data);

        // Return the created user (using their ID)
        $newUserId = self::$pdo->lastInsertId();
        return $this->getUserById($newUserId);
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM Users WHERE user_id = :user_id";
        $statement = self::$pdo->prepare($query);
        $statement->execute(["user_id" => $id]);
        
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    // Method to authenticate a user (login)
    public function authenticate($username, $password)
    {
        $query = "SELECT * FROM Users WHERE username = :username";
        $statement = self::$pdo->prepare($query);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->execute();
        
        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            // Return user data if authentication is successful
            return $row;
        }
        
        // Return null if authentication fails
        return null;
    }

    public function isUsernameOrEmailTaken($username, $email)
    {
        $query = "SELECT COUNT(*) FROM Users WHERE username = :username OR email = :email";
        $statement = self::$pdo->prepare($query);
        $statement->execute(["username" => $username, "email" => $email]);

        return $statement->fetchColumn() > 0;
    }

    
    
}
