<?php
  class Hotel {
    private $db;
    
    public function __construct(){
      $this->db = new Database;
    }

    // Get All Hotels or rooms! 
    public function getHotels(){
      if($_SESSION['user_status'] == 0){      
        $this->db->query("SELECT * FROM hotels 
                            WHERE hotels.id NOT IN 
                            (SELECT books.hotel_id FROM books
                              WHERE books.user_id = :id
                              AND books.approve_status = 0)
                            ORDER BY hotels.created_at DESC;                        
                          ");
      }else{     
        $this->db->query("SELECT * FROM hotels 
                            WHERE hotels.id IN 
                            (SELECT books.hotel_id FROM books
                              WHERE books.approve_status = 0);                        
                          ");
      } 
      $this->db->bind(':id', $_SESSION['user_id']);     
      $results = $this->db->resultset();
      return $results;
    }

    //Book Hotel
    public function bookHotel($id){
      // Prepare Query
      $this->db->query('INSERT INTO books (user_id, hotel_id) 
                         VALUES (:user_id, :hotel_id);');

      // Bind Values
      $this->db->bind(':user_id', $_SESSION['user_id']);
      $this->db->bind(':hotel_id', $id);
      
      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

        //Approve Hotel
        public function approveHotel($id){
          // Prepare Query
          $this->db->query('UPDATE books SET approve_status = 1 WHERE hotel_id = :id');
    
          // Bind Values
          $this->db->bind(':id', $id);
          
          //Execute
          if($this->db->execute()){
            return true;
          } else {
            return false;
          }
        }
  }