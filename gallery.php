<?php 
include './includes/title.php'; 
define('COLS',2);
//initialize variables for the horizontal looper
$pos=0;
$firstRow=true;
//set maximum number of records
define('SHOWMAX',2);
require_once './includes/connection.php';
$conn=dbConnect('read','pdo');
//prepare SQL to get total records
$getTotal='SELECT COUNT(*) FROM images';
$total=$conn->query($getTotal);
$totalPix=$total->fetchColumn();
//set the current page
if(isset($_GET['curPage'])){
    $curPage=$_GET['curPage'];
}else{
    $curPage=0;
}
$startRow= $curPage * SHOWMAX;
if($startRow>$totalPix){
    $startRow=0;
    $curPage=0;
}
//prepare SQL to retrieve subset of image details
$sql="SELECT filename, caption FROM images LIMIT $startRow," . SHOWMAX;
//submit the pdo query
$result=$conn->query($sql);
//get any error messages
$errorInfo=$conn->errorInfo();
if(isset($errorInfo[2])){
    $error=$errorInfo[2];
}else{
    //extract the first recored in the array
    $row=$result->fetch();
    
    if(isset($_GET['image'])){
        $mainImage=$_GET['image'];
    }else{
        $mainImage=$row['filename'];    
    }
    if(file_exists('images/'.$mainImage)){
        //get the dimensions of the main image
        $imageSize=getimagesize('images/'.$mainImage)[3];
    }else{
        $error='Image not found';
    }
}
//submit the mysqli query
// $result=$conn->query($sql);
// if(!$result){
//     $error=$conn->error;
// }else{
//     //extract the first record as an array
//     $row=$result->fetch_assoc();
    //    $mainImage=$row['filename'];
    //     $caption=$row['caption'];
    // //get the dimensions of the main image
    // $imageSize=getimagesize('images/'.$mainImage)[3];
// }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Japan Journey<?php if(isset($title)){ echo " &#8212; {$title}";}?></title>
    <link href="css/journey.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <h1>Japan Journey </h1>
</header>
<div id="wrapper">
    <?php require './includes/menu.php'; ?>
    <main>
        <h2>
        <?php 
            if(isset($error)){
                echo "<p>$error</p>";
            }else{
        ?>  
        Images of Japan</h2>
      <p id="picCount">Displaying 
        <?php echo $startRow+1;
            if($startRow+1 < $totalPix){
                echo ' to ';
                if($startRow+SHOWMAX<$totalPix){
                    echo $startRow+SHOWMAX;
                }else{
                    echo $totalPix;
                }
            }
        echo " of $totalPix";
        ?>
      </p>
        <div id="gallery">
            <table id="thumbs">
                <tr>
					<!--This row needs to be repeated-->
                    <?php do{ 
                            //set caption if thumbnail is same as main image
                            if($row['filename']== $mainImage){
                                $caption=$row['caption'];//this is the line you pasted
                            }
                            //if remainder is not 0 and not first row and start new one
                            if($pos++ % COLS === 0 && !$firstRow){
                                echo '</tr><tr>';
                            }
                            //once loop begins, this is no longer true
                            $firstRow=false;
                     ?>

                    <td><a href="<?= $_SERVER['PHP_SELF']; ?>?image=<?= $row['filename']; ?>
                        &amp;curPage=<?= $curPage;?>">
                        <img src="images/thumbs/<?= $row['filename']; ?>" 
                        alt="<?= $row['caption'];?>" width="80" height="54"></a></td>
                            <!--this is the statement for pdo method-->
                    <?php } while ($row=$result->fetch()); 
                        while($pos++ % COLS){
                            echo '<td>&nbsp;</td>';
                        }
                    ?>

                </tr>
				<!-- Navigation link needs to go here -->
                <tr><td>
                   <?php 
                   //create a back link if current page greater then 0
                   if($curPage>0){
                        echo '<a href="' .$_SERVER['PHP_SELF']. '?curPage=' . ($curPage-1) . 
                        '">&lt; Prev</a>';
                    }else{
                        //otherwise leave the cell empty
                        echo '&nbsp;';
                    }
                   ?> 
                   </td>
                    <?php 
                    //pad the final row with empty cells if more then 2 columns
                    if(COLS-2>0){
                        for($i=0;$i<COLS-2;$i++){
                            echo '<td>&nbsp;</td>';
                        }
                    } 
                    ?>
                    <td>
                    <?php 
                    //create a forward link if more records exist
                    if($startRow+SHOWMAX<$totalPix){
                        echo '<a href="' .$_SERVER['PHP_SELF']. '?curPage=' . ($curPage+1) .
                        '">Next &gt;</a>';
                    }else{
                        //otherwise leave the cell empty
                        echo '&nbsp;';
                    } 
                    ?>  
                    </td></tr>
                    
            </table>
            <figure id="main_image">
                <img src="images/<?= $mainImage; ?>" alt="<?= $caption; ?>" <?= $imageSize; ?>>
                <figcaption><?= $caption; ?></figcaption>
            </figure>
        </div>
        <?php } ?>
    </main>
    <?php include './includes/footer.php'; ?>
</div>
</body>
</html>