 <div class="cards">
     <div class="card card-1">
         <div class="card--data">
             <div class="card--content">
                 <h5 class="card--title">Total<br> Contacts</h5>
                 <h1><?php echo $row_count; ?></h1>
             </div>
             <i class="ri-contacts-book-fill card--icon--lg"></i>
         </div>
     </div>
     <div class="card card-2">
         <div class="card--data">
             <div class="card--content">
                 <h5 class="card--title">New<br> Contacts</h5>
                 <h1><?php

                        $row_logs = $stmt_logs->fetch(PDO::FETCH_ASSOC);
                        $section_name = "New Contact";
                        if ($row_logs['section'] = $section_name) {
                            $row_Count = $stmt_logs->rowCount();
                            echo $row_Count;
                        }
                        ?></h1>
             </div>
             <i class="ri-user-line card--icon--lg"></i>
         </div>
     </div>
 </div>
 <!--Dashboard Cards End-->