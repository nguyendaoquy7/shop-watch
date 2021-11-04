<?php
	$sql = "SELECT * FROM product";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<div class='col-sm-3 mb-3'>";
                echo "<div class='card'>";
                    echo "<div class='card-body'>";
                        echo "<div class='d-flex flex-column align-items-center text-center'>";
                            echo '<img src="./images    /'.$row["img"].'" alt='.$row["nameproduct"].' class="rounded-circle" width="200" height="200">';
                            echo "<div class='mt-3'>";
                                echo '<p class="text-secondary mb-1">'.$row["nameproduct"].'</p>';
                                echo '<p class="text-muted font-size-sm"> '.$row["price"].' $ </p>';
                                echo "<a href='view.php?id=".$row['id']." ' class='btn btn-primary'>VIEW</a>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
		}
	}else {
		echo "0 results";
	}
	$conn->close();
?>