<?php
    class PDF extends FPDF {
        function Header() {
        }

        function Footer() {
            $this->SetFont('Arial', 'I', 8);
            $this->SetTextColor(150);
            $this->SetY(-25);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'R');
            $this->SetY(-25);
            $this->Cell(0, 10, 'RMR Customs Brokerage Corporation', 0, 0, 'L');
        }
    }
?>