<?php
// chart-data.php
include 'includes/conn.php';

header('Content-Type: application/json');

$data = [];

$sql = "SELECT * FROM positions ORDER BY priority ASC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $positionId = $row['id'];
    $positionTitle = $row['description'];
    $slug = 'chart_' . strtolower(preg_replace('/[^a-z0-9]+/', '_', $positionTitle));

    $candidates = [];
    $votes = [];
    $colors = [];

    $csql = "SELECT id, lastname FROM candidates WHERE position_id = '$positionId'";
    $cquery = $conn->query($csql);

    while ($crow = $cquery->fetch_assoc()) {
        $candidates[] = $crow['lastname'];

        $vsql = "SELECT COUNT(*) AS total FROM votes WHERE candidate_id = '{$crow['id']}'";
        $vquery = $conn->query($vsql);
        $vrow = $vquery->fetch_assoc();
        $votes[] = (int)$vrow['total'];

        $colors[] = sprintf('rgba(%d,%d,%d,0.8)', rand(50,200), rand(50,200), rand(50,200));
    }

    if (!empty($candidates)) {
        $data[] = [
            'id' => $slug,
            'title' => $positionTitle,
            'labels' => $candidates,
            'data' => $votes,
            'backgroundColor' => $colors
        ];
    }
}

echo json_encode($data);
