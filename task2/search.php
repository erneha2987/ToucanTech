<?php
// Define a class for encapsulating the database connection and query functions
class Database {
    // Private member variable to hold the database connection
    private $conn;

    // Constructor that establishes a database connection
    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // Method to search for matching profiles
    public function search_profiles($name) {
        // Construct a SQL query to find matching users
        $sql = "SELECT FirstName, LastName, Email FROM profiles WHERE CONCAT(FirstName, ' ', LastName) LIKE '%$name%'";
        // Execute the query and return the result object
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    // Destructor that closes the database connection
    public function __destruct() {
        mysqli_close($this->conn);
    }
}

// Define a class for encapsulating the search functionality and results display
class Search {
    // Private member variable to hold the Database object
    private $db;

    // Constructor that takes a Database object as input
    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Method to run the search and display the results
    public function search($name) {
        // Run the search using the search_profiles method of the Database object
        $result = $this->db->search_profiles($name);
        // Display the results as a table or a message
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-striped'><tr><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>".$row['FirstName']."</td><td>".$row['LastName']."</td><td>".$row['Email']."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No results found";
        }
    }
}

// Create a new Database object and connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_task";
$db = new Database($servername, $username, $password, $dbname);

// Create a new Search object and run the search
$search = new Search($db);
$name = $_POST['name'];
$search->search($name);
?>
