<?php
class UserManager {
    private array $users;
    private PDO $db; 

    public function __construct(PDO $db) {
        $this->db = $db;
        $this->users = [];
    }

    public function loadUsers(): void {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->query($sql);

        $usersArray = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($row['username'], $row['email'], $row['password'], $row['role']);
            $user->setId($row['id']);
            $usersArray[] = $user;
        }

        $this->setUsers($usersArray);
    }

    public function getUsers(): array {
        return $this->users;
    }

    public function setUsers(array $users): void {
        $this->users = $users;
    }
}
