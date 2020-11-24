<?php  

    class Job{
        // Variables
        private $db;

        //Constructeur
        public function __construct(){
            $this->db = new Database;
        }

        // Recuperer tout les Jobs
        public function getAllJobs(){
            //Requete SQL
            $this->db->query("SELECT jobs.*, categories.name AS cname
            FROM jobs
            INNER JOIN categories 
            ON jobs.category_id = categories.id
            ORDER BY post_date DESC");

            // Assigner les resultats
            $results = $this->db->resultSet();

            // Afficher les resultats
            return $results;
        }

        // Récuperer liste catégories
        public function getCategories() {
            //Requete SQL
            $this->db->query("SELECT * FROM categories");

            // Assigner les resultats
            $results = $this->db->resultSet();

            // Afficher les resultats
            return $results;
        }

        // Récuperer nom catégorie
        public function getCategory($category_id) {
            //Requete SQL
            $this->db->query("SELECT * FROM categories WHERE id = :category_id");
            $this->db->bind(':category_id', $category_id);

            // Assigner ligne
            $row = $this->db->single();

            // Afficher le resultat
            return $row;
        }

        // Resultats par categorie
        public function getByCategory($category) {
            //Requete SQL
            $this->db->query("SELECT jobs.*, categories.name AS cname
            FROM jobs
            INNER JOIN categories 
            ON jobs.category_id = categories.id
            WHERE jobs.category_id = $category
            ORDER BY post_date DESC");

            // Assigner les resultats
            $results = $this->db->resultSet();
            
            // Afficher les resultats
            return $results;
        }

        // Récuperer nom job
        public function getJob($id) {
            //Requete SQL
            $this->db->query("SELECT * FROM jobs WHERE id = :id");
            $this->db->bind(':id', $id);

            // Assigner ligne
            $row = $this->db->single();

            // Afficher le resultat
            return $row;
        }

        // Créer une annonce
        public function create($data) {
            // Requête SQL
            $this->db->query("
                INSERT INTO jobs (category_id, job_title, company, description, location, salary, contact_user, contact_email)
                VALUES (:category_id, :job_title, :company, :description, :location, :salary, :contact_user, :contact_email)
            ");

            // Binder
            $this->db->bind(':category_id', $data['category_id']);
            $this->db->bind(':job_title', $data['job_title']);
            $this->db->bind(':company', $data['company']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':location', $data['location']);
            $this->db->bind(':salary', $data['salary']);
            $this->db->bind(':contact_user', $data['contact_user']);
            $this->db->bind(':contact_email', $data['contact_email']);

            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    
        // Supprimer annonce
        public function delete($id) {
            // Requête SQL
            $this->db->query("
                DELETE FROM jobs WHERE id = $id;
            ");

            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Mettre à jour une annonce
        public function update($id, $data) {
            // Requête SQL
            $this->db->query("UPDATE jobs
				SET 
				category_id = :category_id,
				job_title = :job_title,
				company = :company,
				description = :description,
				location = :location,
				salary = :salary,
				contact_user = :contact_user,
				contact_email = :contact_email 
				WHERE id = $id");

            // Binder
            $this->db->bind(':category_id', $data['category_id']);
            $this->db->bind(':job_title', $data['job_title']);
            $this->db->bind(':company', $data['company']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':location', $data['location']);
            $this->db->bind(':salary', $data['salary']);
            $this->db->bind(':contact_user', $data['contact_user']);
            $this->db->bind(':contact_email', $data['contact_email']);

            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
        
    }
?>

