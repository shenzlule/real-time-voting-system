<?php
include 'includes/session.php';
require_once('../tcpdf/tcpdf.php'); // Adjust path as needed

// Fetch election title dynamically from elections table (assuming single record)
$election_title = "Election Tally Results"; // default fallback
$sql = "SELECT election_name FROM elections LIMIT 1";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $election_title = htmlspecialchars($row['election_name']);
}

function generateRow($conn) {
    $contents = '';
    $sql = "SELECT * FROM positions ORDER BY priority ASC";
    $query = $conn->query($sql);

    while ($row = $query->fetch_assoc()) {
        $positionId = $row['id'];
        $positionTitle = htmlspecialchars($row['description']);

        // Colored header for each position
        $contents .= '
            <tr style="background-color:#4A90E2; color:#fff;">
                <td colspan="2" align="center" style="font-size:16px; font-weight:bold;">' . $positionTitle . '</td>
            </tr>
            <tr style="background-color:#d0e4f7; color:#333;">
                <td width="80%" style="padding:6px;"><b>Candidate</b></td>
                <td width="20%" style="padding:6px;"><b>Votes</b></td>
            </tr>
        ';

        $csql = "SELECT * FROM candidates WHERE position_id = '$positionId' ORDER BY lastname ASC";
        $cquery = $conn->query($csql);

        while ($crow = $cquery->fetch_assoc()) {
            $vsql = "SELECT COUNT(*) as total FROM votes WHERE candidate_id = '" . $crow['id'] . "'";
            $vquery = $conn->query($vsql);
            $vrow = $vquery->fetch_assoc();
            $votes = $vrow['total'];

            $fullName = htmlspecialchars($crow['lastname'] . ', ' . $crow['firstname']);

            // Alternate row colors for readability
            static $alt = false;
            $bgcolor = $alt ? '#f9f9f9' : '#ffffff';
            $alt = !$alt;

            $contents .= "
                <tr style='background-color:$bgcolor;'>
                    <td style='padding:6px;'>$fullName</td>
                    <td style='padding:6px;' align='center'>$votes</td>
                </tr>
            ";
        }
    }

    return $contents;
}

// Initialize TCPDF
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Result: $election_title");
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 12);
$pdf->AddPage();

// Build HTML content with inline styles for colors
$content = '
    <h1 style="text-align:center; color:#0077cc;">' . $election_title . '</h1>
    <h3 style="text-align:center; color:#555;">Vote Tally Summary</h3>
    <table border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse; width:100%;">
';
$content .= generateRow($conn);
$content .= '</table>';

// Output the PDF
$pdf->writeHTML($content);
$pdf->Output('election_results.pdf', 'I');
?>
