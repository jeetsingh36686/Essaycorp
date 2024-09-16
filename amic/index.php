<?php
include "connection.php";

if(isset($_POST['submit'];)){

$email = $_POST["email"];
$subject = $_POST["subject"];
$assessment = $_POST["assessment"];
$budget = $_POST["budget"];
$pages = $_POST["pages"];
$nowordlimit = isset($_POST["nowordlimit"]) ? 1 : 0;
$number = $_POST["number"];
$deadline = $_POST["deadline"];
$discount = isset($_POST["discount"]) ? 1 : 0;

if(isset($_FILES["file"])){

  $file_name = $_FILES["file"]["name"];
  $file_tmp_name = $_FILES["file"]["tmp_name"];
  $directory = "files/";
  $file_content= file_get_contents($file_tmp_name);
  move_uploaded_file($file_tmp_name, $directory . $file_name);
  

}

$stmt = $conn->prepare("INSERT INTO booking_details( email, assessment, subject, budget, pages, no_word_limit, number, deadline, discount, file_name, file_content	)
 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if($stmt === false){
  die("error in sql query") . $conn->error;
}

$stmt->bind_param("sssssissisb",  $email,$assessment, $subject, $budget, $pages, $nowordlimit, $number, $deadline, $discount, $file_name, $file_content);

if($stmt->execute()){
echo "<script>alert('your order has been booked successfully')</script>";
}
else{
  echo "data insertion failed";
}

$stmt->close();
$conn->close();

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <!--header navbar-->
    <header>
        <nav class="flex justify-between bg-white items-center px-4 border-b-4 border-gray-200 pr-20 fixed w-full z-50">
            <div class="flex items-center ">
                <img class="w-20" src="navbar images/essaycorp.png">
                <h1 class="text-4xl text-blue-600 font-bold">EssayCorp</h1>
                <div class="flex flex-col ">
                    <i class="fa-solid fa-9 text-yellow-300 text-xl inline">
                        <span class="text-[10px] text-yellow-300">years</span>
                    </i>
                    <div class="bg-white inline py-0">
                        <i class="fa-solid fa-star text-yellow-300 text-[8px]"></i>
                        <i class="fa-solid fa-star text-yellow-300 text-[8px]"></i>
                        <i class="fa-solid fa-star text-yellow-300 text-[8px]"></i>
                        <i class="fa-solid fa-star text-yellow-300 text-[8px]"></i>
                        <i class="fa-solid fa-star text-yellow-300 text-[8px]"></i>
                    </div>
                </div>

            </div>
            <ul class="flex w-[600px] text-xl justify-between">
                <span class="flex">
                    <li>Services</li>
                    <i class="fa-solid fa-sort-down pl-2"></i>
                </span>
                <li>Experts</li>
                <li>Reviews</li>
                <li>About us</li>
                <span class="flex">
                    <li>Subject</li>
                    <i class="fa-solid fa-sort-down pl-2"></i>
                </span>                
                <span class="flex">
                    <li>Resources</li>
                    <i class="fa-solid fa-sort-down pl-2"></i>
                </span>            
            </ul>
            <div class="">
                <input type="button" value="Order now" class="bg-red-700 hover:bg-red-800 border-red-900 border-2 text-white text-xl font-bold rounded-lg p-2">
                <i class="fa-solid fa-user-pen text-2xl pl-3"></i>
            </div>
        </nav>

    </header>

    <main>
        <!--section 1-->
        <section class="pt-28">
            <div class="flex justify-between w-full bg-white">
                <!--left side-->
                <div class="bg-white w-[55%] p-10">
                    <h1 class="text-6xl font-bold text-blue-600
                    "><span class="text-red-800">#1 Assignment</span> Writing <span class="text-red-800">Services</span> by Experts</h1>
                    <p class="text-2xl font-semi-bold py-4">Essay writing assistance by professional Ph.D. Experts Book now with us</p>
                    <div class="mt-16">
                        <p class="text-lg font-semi-bold">1.2M Trusted & Happy Customers</p>
                        <div class="flex bg-white w-[280px] justify-between p-1 border-2 border-gray-300">
                            <img class="w-32 h-[80px] bg-white" src="navbar images/googlereview.png" alt="google reviews">
                            <img  class="w-32 h-16"src="navbar images/trustpilot.png" alt="trustpilot reviews">
                        </div>
                    </div>
                </div>
                <!--right side-->
                <div class="bg-white w-[45%] flex justify-center items-center">
                    <div class="w-[75%] bg-gradient-to-r from-yellow-500 via-yellow-200 to-yellow-500 rounded-lg">
                    <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST" enctype="multipart/form-data" class=" bg-white rounded-base m-3 p-3">
                        <h1 class="font-bold text-lg mb-4">Trusted Assignment Help by Real Experts</h1>
                        <div class="flex justify-between">
                            <input type="email" placeholder="Enter Email" name="email" class="w-[45%] text-black border-2 border-black pl-2">
                            <select id="assessment" name="assessment" class="border-2 border-black pl-2 w-[45%]">
                                <option>Assessment</option>
                                <option>Writing Blogs</option>
                                <option>Creating Files</option>
                                <option>Project Creation</option>
                            </select>
                        </div>
                        <div class="flex justify-between mt-5">
                            <input type="text" placeholder="Subject" name="subject" class="w-[45%] text-black border-2 border-black pl-2">
                            <select name="budget" id="budget" name="budget" class="border-2 border-black pl-2 w-[45%]">
                                <option>$ Budget</option>
                                <option>$100</option>
                                <option>$200</option>
                                <option>$300</option>
                                <option>$400</option>
                                <option>$500</option>
                                <option>$600</option>

                            </select>
                        </div>
                        <div class="mt-5 flex justify-between">
                            <div class="flex w-[45%]">
                                <input type="button" value="-" id="decrement" class="border-black border-2 w-9">
                                <div class="border-black border-y-2 flex">
                                    <span class="mx-2">Pages</span><input type="text" value="0" placeholder="Pages" name="pages" id="pages" class="pl-2 border-black border-1 w-16 outline-none">
                                </div>
                                <input type="button" value="+" id="increment" class="border-black border-2 w-9">
                            </div>
                            <div class="w-[45%] flex items-center">
                                <input type="checkbox" name="nowordlimit" id="togglewordlimit" class="toggle">
                                <label for="togglewordlimit"  class="switch"></label>

                                <label for="togglewordlimit" class="ml-4">No word limit</label>
                            </div>
                        </div>
                        <div class="mt-5 flex justify-between">
                                <input type="text" class=" w-[45%] text-black border-2 border-black pl-2" name="number" minlength="10" maxlength="10" placeholder="Your Number">
                                <input type="text" class=" w-[45%] text-black border-2 border-black pl-2" name="deadline" placeholder="Deadline">
                        </div>
                        <div class="w-full flex items-center mt-5">
                            <input type="checkbox" name="discount" id="discount" class="toggle">
                            <label for="discount" class="switch"></label>

                            <label for="discount" class="ml-4">Get a Flat 10% off on First Booking</label>
                        </div>
                        <div class="w-full text-black border-2 border-gray-500 bg-white mt-5 p-1">
                            <input type="file" name="file" id="file">
                        </div>
                        <div class="text-center mt-7">
                            <input type="submit" name="submit" class=" bg-yellow-400 hover:bg-yellow-500 border-yellow-600 border-2 px-2 text-lg font-bold w-32" value="Submit">
                        </div>
                    </form>
                    </div>
                </div>
                </div>
        </section>

        <!--section 2-->
        <section>
            <div class="my-20">
                
                    <div class="mx-auto max-w-7xl px-2 lg:px-8">
                      <div class="mb-4 max-w-xl m-auto">
                        <h2 class="mt-6 text-4xl font-bold leading-tight text-black text-center">
                            Reasons Why You Should Choose EssayCorp
                        </h2>
                      </div>
                      <hr />
                      <div class="mt-8 grid grid-cols-1 items-center gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <div class="flex items-start">
                         
                          <div class="ml-5 flex items-center justify-center flex-col">
                            <div class=" flex items-center justify-center">
                                <img src="navbar images/trustworthy.png" alt="image" class="w-28 text-center">
                            </div>
                            <h3 class="text-xl font-bold text-black ">
                                Trustworthy Experts
                            </h3>
                            <p class="mt-3 text-base text-black font-semibold">
                              Our Team of highly qualified experts ensures
                              exceptional and reliable academic support for all
                              your assignment need
                            </p>
                          </div>
                        </div>

                        <div class="flex items-start">
                          <div class="ml-5 flex justify-center items-center flex-col">
                            <div>
                                <img src="navbar images/quality.png" alt="image" class="w-28 text-center">
                            </div>
                            <h3 class="text-xl font-bold text-black">Quality Writing</h3>
                            <p class="mt-3 text-base text-black font-semibold">
                                Our dedication to quality ensures each assignment is well-researched, clearly written, and meets the highest academic standards.
                            </p>
                          </div>
                        </div>
                        <div class="flex items-start">
                          
                          <div class="ml-5 flex justify-center items-center flex-col">
                            <div>
                                <img src="navbar images/timelydelivered.png" alt="image" class="w-28 text-center">
                            </div>
                            <h3 class="text-xl font-bold text-black">
                                Timely Delivered
                            </h3>
                            <p class="mt-3 text-base text-black font-semibold">
                                We guarantee timely delivery of every assignment, ensuring you meet your deadlines with well-researched, high quality work every time.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mx-auto max-w-7xl px-2 lg:px-8">
                        
                        <div class="mt-8 grid grid-cols-1 items-center gap-6 md:grid-cols-2 lg:grid-cols-3">
                          <div class="flex items-start">
                           
                            <div class="ml-5 flex items-center justify-center flex-col">
                              <div class=" flex items-center justify-center">
                                  <img src="navbar images/rework.png" alt="image" class="w-28 text-center">
                              </div>
                              <h3 class="text-xl font-bold text-black ">
                                Free Rework Policy
                              </h3>
                              <p class="mt-3 text-base text-black font-semibold">
                                Our free-work policy ensures revisions until your assignment meets your exact requirements and satisfaction.
                              </p>
                            </div>
                          </div>
  
                          <div class="flex items-start">
                            <div class="ml-5 flex items-center justify-center flex-col">
                                <div>
                                    <img src="navbar images/budget.png" alt="image" class="w-28 text-center">
                                </div>
                              <h3 class="text-xl font-bold text-black">Budget-Friendly Service</h3>
                              <p class="mt-3 text-base text-black font-semibold">
                                Our budget-friendly service delivers quality academic support at affordable rates, making excellence accessible without overspending.
                              </p>
                            </div>
                          </div>
                          <div class="flex items-start">
                            
                            <div class="ml-5 flex items-center justify-center flex-col ">
                                <div>
                                    <img src="navbar images/availbility.png" alt="image" class="w-28 text-center">
                                </div>
                              <h3 class="text-xl font-bold text-black">
                                24/7 Availability
                              </h3>
                              <p class="mt-3 text-base text-black font-semibold">
                                Our 24/7 Availability ensures you receive support anytime, guaranteeing assistance whenever you need it, day or night.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                  
                  
            </div>
        </section>
    </main>
<script src="index.js"></script>
</body>
</html>