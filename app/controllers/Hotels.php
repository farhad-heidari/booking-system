<?php
  class Hotels extends Controller {
      public function __construct(){
        if(!isset($_SESSION['user_id'])){
            redirect('users/login');            
          }
          $this->hotelModel = $this->model('Hotel');
          $this->userModel = $this->model('User');
      }
      public function index(){
        $hotels = $this->hotelModel->getHotels();
        $data = [
            'hotels' => $hotels
        ];

        $this->view('hotels/index', $data);
      }

      public function book($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          //Execute
          if($this->hotelModel->bookHotel($id)){
            // Redirect to login
            flash('hotel_message', 'Hotel Booked');
            redirect('hotels');
            } else {
              die('Something went wrong');
            }
        } else {
          redirect('hotels');
        }

      }

      public function approve($id){
        if($_SESSION['user_status']){
          redirect('hotels');
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          //Execute
          if($this->hotelModel->approveHotel($id)){
            // Redirect to login
            flash('hotel_message', 'Hotel approved');
            redirect('hotels');
            } else {
              die('Something went wrong');
            }
        } else {
          redirect('hotels');
        }

      }
  }