<?php
    class PDF extends tFPDF {
        function AddCustomPage($orientation='', $size='')
        {
            // Start a new page
            if($this->state==0)
                $this->Open();
            $family = $this->FontFamily;
            $style = $this->FontStyle.($this->underline ? 'U' : '');
            $fontsize = $this->FontSizePt;
            $lw = $this->LineWidth;
            $dc = $this->DrawColor;
            $fc = $this->FillColor;
            $tc = $this->TextColor;
            $cf = $this->ColorFlag;
            if($this->page>0)
            {
                // Page footer
                $this->InFooter = true;
                $this->Footer();
                $this->InFooter = false;
                // Close page
                $this->_endpage();
            }
            // Start new page
            $this->_beginpage($orientation,$size);
            // Set line cap style to square
            $this->_out('2 J');
            // Set line width
            $this->LineWidth = $lw;
            $this->_out(sprintf('%.2F w',$lw*$this->k));
            // Set font
            if($family)
                $this->SetFont($family,$style,$fontsize);
            // Set colors
            $this->DrawColor = $dc;
            if($dc!='0 G')
                $this->_out($dc);
            $this->FillColor = $fc;
            if($fc!='0 g')
                $this->_out($fc);
            $this->TextColor = $tc;
            $this->ColorFlag = $cf;
            // Page header
            $this->InHeader = true;
            $this->CustomHeader();
            $this->InHeader = false;
            // Restore line width
            if($this->LineWidth!=$lw)
            {
                $this->LineWidth = $lw;
                $this->_out(sprintf('%.2F w',$lw*$this->k));
            }
            // Restore font
            if($family)
                $this->SetFont($family,$style,$fontsize);
            // Restore colors
            if($this->DrawColor!=$dc)
            {
                $this->DrawColor = $dc;
                $this->_out($dc);
            }
            if($this->FillColor!=$fc)
            {
                $this->FillColor = $fc;
                $this->_out($fc);
            }
            $this->TextColor = $tc;
            $this->ColorFlag = $cf;
        }

        function CustomHeader() {}

        function Header($id = '') {
            $this->SetFillColor(25, 40, 35);
            $this->SetMargins(10, 15, 10); // Page Max Content Width: 196
            
            if($this->PageNo() == 1) {
                $this->SetFont('DejaVu', '', 20);
                $this->SetTextColor(25, 40, 35);
                $this->Cell(0, 8, 'RMR Customs Brokerage Corporation', 0, 0, 'L');
                $this->Ln();
                $this->SetFont('DejaVu', '', 10);
                $this->Cell(0, 5, 'Income per Client Report', 0, 0, 'L');
                $this->Ln(20);
            }

            $this->SetFont('DejaVu', '', 10);
            $this->SetTextColor(255, 255, 255);
            $this->Cell(76, 10, 'Client Name', 1, 0, 'C', true);
            $this->Cell(40, 10, 'Credit', 1, 0, 'C', true);
            $this->Cell(40, 10, 'Debit', 1, 0, 'C', true);
            $this->Cell(40, 10, 'No. of Transactions', 1, 0, 'C', true);
            $this->Ln();
            $this->SetFont('DejaVu', '', 8);
            $this->SetTextColor(25, 40, 35);
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