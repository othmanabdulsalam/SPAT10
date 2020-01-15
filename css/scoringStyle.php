<?php
header("Content-type: text/css; charset: UTF-8");
?>
.scorerBackground {
background-color: #015A82;
}

.scorerSeparation {
border-width: 4px;
border-color: #015A82;
}


/** Show and Hide Evidence */
<?php
$i = 1;
for ($i; $i<=100; $i++)
{?>
    .evidence<?php echo $i?> {
    display: none;
    width: 100%;
    height: 100%;
    }
    #triggerEvidence<?php echo $i?>:checked + .evidence<?php echo $i?> {
    display: block;
    }
    #triggerEvidence<?php echo $i?>{
    display:none;
    }

    #evidenceLabel<?php echo $i?>
    {
    font-size: 15px;
    border-style: outset;
    border-color: #015A82;
    }

    #evidenceLabel<?php echo $i?>:hover
    {
        background-color: #015A82;
        color: white;
    }
<?php } ?>

/* Style the Image Used to Trigger the Modal */
#myImg {
border-radius: 5px;
cursor: pointer;
transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
padding-top: 100px; /* Location of the box */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
margin: auto;
display: block;
width: 80%;
max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
margin: auto;
display: block;
width: 80%;
max-width: 700px;
text-align: center;
color: #ccc;
padding: 10px 0;
height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
animation-name: zoom;
animation-duration: 0.6s;
}

@keyframes zoom {
from {transform:scale(0)}
to {transform:scale(1)}
}

/* The Close Button */
.close {
position: absolute;
top: 15px;
right: 35px;
color: #f1f1f1;
font-size: 40px;
font-weight: bold;
transition: 0.3s;
}

.close:hover,
.close:focus {
color: #bbb;
text-decoration: none;
cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
.modal-content {
width: 100%;
}
}
