<?php
// tickets.php

function getTicketsByFlightId($flightId, $conn)
{
    $sql = "SELECT * FROM tickets WHERE flight_id = '$flightId'";
    $result = $conn->query($sql);

    $tickets = [];
    while ($row = $result->fetch_assoc()) {
        $tickets[] = $row;
    }

    return $tickets;
}

if (isset($_GET['flight_id'])) {
    $flight_id = $_GET['flight_id'];

    require_once('dbconnect.php');

    // Fetch ticket data based on the flight_id
    $tickets = getTicketsByFlightId($flight_id, $conn);

    // Close the MySQLi connection
    $conn->close();

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tickets for Flight <?php echo $flight_id; ?></title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }

            .container {
                max-width: 800px;
                margin: 0 auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .book-button {
                background-color: #4CAF50;
                color: white;
                border: none;
                padding: 8px 16px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 14px;
                cursor: pointer;
            }

            .book-button:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Tickets for Flight <?php echo $flight_id; ?></h1>
            <table>
                <thead>
                    <tr>
                        <th>Ticket Number</th>
                        <th>Flight ID</th>
                        <th>Price</th>
                        <th>Seat Number</th>
                        <th>Class</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the fetched tickets and display them in the table
                    foreach ($tickets as $ticket) {
                        ?>
                        <tr>
                            <td><?php echo $ticket['ticket_number']; ?></td>
                            <td><?php echo $ticket['flight_id']; ?></td>
                            <td><?php echo $ticket['price']; ?></td>
                            <td><?php echo $ticket['seat_number']; ?></td>
                            <td><?php echo $ticket['class']; ?></td>
                            <td>
                                <form method="post" action="book_ticket.php">
                                    <input type="hidden" name="flight_id" value="<?php echo htmlspecialchars($ticket['flight_id']); ?>">
                                    <input type="hidden" name="ticket_number" value="<?php echo htmlspecialchars($ticket['ticket_number']); ?>">
                                    <input type="hidden" name="price" value="<?php echo htmlspecialchars($ticket['price']); ?>">
                                    <input type="hidden" name="seat_number" value="<?php echo htmlspecialchars($ticket['seat_number']); ?>">
                                    <input type="hidden" name="class" value="<?php echo htmlspecialchars($ticket['class']); ?>">
                                    <button type="submit" class="book-button">Book</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "Flight ID not specified.";
}
?>