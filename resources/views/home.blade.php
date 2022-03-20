@extends('layouts.app')

@section('content')
<style>
    .container img {
        max-width:200px;
        max-height:150px;
        width: auto;
        height: auto;
    }
    .card-titles {
        width: 13rem; 
        float: left; 
        margin-right: 1%
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card col-md-12">
                <div class="card-header">

                    <div class="card card-titles">
                        <img class="card-img-top" src="img/api.jpg" alt="dashboard">
                    </div>
                    <b>End-points</b>
                    <a href="{{ url('/Collection/Tecnofit.postman_collection.json') }}" target="_blank">Collection</a>
                </div>
                
            </div>
            
        </div>
    </div>
    <div class="card-deck">
        <?php
        $i = 0;
        foreach($ranking as $rankings) {
            $movement = '';
            if (isset($ranking[$i]["ranking"][$i]["movement"])){
                $movement = $ranking[$i]["ranking"][$i]["movement"];
            }
            foreach($rankings  as $key => $personalRecord) {
                
                echo '<div class="card">
                        <h4 class="card-header">'.$movement.'</h4><hr>';
                foreach($personalRecord as $personalRecords) {
                    echo '<div class="card-body">
                            <h5 class="card-title">Record Pessoal</h5>
                            <ul>'.$personalRecords['user'].'
                                <li>Position: <b>'.$personalRecords['position'].'</b></li>
                                <li>Value: <b>'.$personalRecords['value'].'</b></li>
                                <li>Date: <b>'.$personalRecords['date'].'</b></li>
                                <li>movement_id: <b>'.$personalRecords['movement_id'].'</b></li>
                            </ul></div>';
                }
                echo '</div>';
                $i++;
            }           
        }
        ?>       
    </div>   
</div>
@endsection