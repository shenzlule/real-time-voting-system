<?php
include 'includes/session.php';
require_once('./tcpdf/tcpdf.php');

// Fetch election details
$election = [
    'name' => 'Student Election',
    'date' => '',
    'start' => '',
    'end' => '',
    'released' => 0
];

$sql = "SELECT * FROM elections ORDER BY election_date DESC LIMIT 1";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $election['name'] = htmlspecialchars($row['election_name']);
    $election['date'] = date("F j, Y", strtotime($row['election_date']));
    $election['start'] = date("g:i A", strtotime($row['start_time']));
    $election['end'] = date("g:i A", strtotime($row['end_time']));
    $election['released'] = (int)$row['release_voting_guide'];
}

// Setup PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Voter Guide - " . $election['name']);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 15, 15);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

if (!$election['released']) {
    // Show "not available yet" message
    $html = '
        <h1 style="text-align:center; color:#cc0000;">Voter Guide Not Available</h1>
        <p style="text-align:center; color:#555; font-size:16px;">
            The voter guide for <strong>' . $election['name'] . '</strong> is not yet available.
            Please check back later or contact the election committee for updates.
        </p>';
} else {
    // Build guide content
    function getCandidateInfo($conn) {
        $output = '';
        $sql = "SELECT p.description AS position, c.firstname, c.lastname, c.platform
                FROM candidates c
                JOIN positions p ON c.position_id = p.id
                ORDER BY p.priority ASC, c.lastname ASC";
        $query = $conn->query($sql);

        $currentPosition = '';
        while ($row = $query->fetch_assoc()) {
            if ($currentPosition !== $row['position']) {
                $currentPosition = $row['position'];
                $output .= '<h3 style="color:#0077cc;">' . htmlspecialchars($currentPosition) . '</h3>';
            }
            $name = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
            $bio = !empty($row['platform']) ? htmlspecialchars($row['platform']) : 'No platform provided.';
            $output .= "<p><strong>$name:</strong> $bio</p>";
        }

        return $output;
    }

    $html = '
        <h1 style="text-align:center; color:#0077cc;">' . $election['name'] . ' - Voter Guide</h1>
        <hr>
        <h2 style="color:#333;">🗓️ Key Election Information</h2>
        <ul>
            <li><strong>Date:</strong> ' . $election['date'] . '</li>
            <li><strong>Voting Starts:</strong> ' . $election['start'] . '</li>
            <li><strong>Voting Ends:</strong> ' . $election['end'] . '</li>
        </ul>

        <h2 style="color:#333;">🧾 Voting Instructions</h2>
        <ol>
            <li>Log in to the voting portal during the election time.</li>
            <li>Review each candidate\'s profile and platform.</li>
            <li>Cast your vote and ensure you receive a confirmation message.</li>
            <li>Votes are final once submitted.</li>
        </ol>

        <h2 style="color:#333;">👥 Candidate Profiles</h2>
        ' . getCandidateInfo($conn) . '

        <br><br>
        <p style="font-size:11px; color:gray;">Generated on ' . date("F j, Y, g:i A") . '</p>
    ';
}

$pdf->writeHTML($html);
$pdf->Output('Voter_Guide.pdf', 'I');
?>
