<!doctype <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aston Animal Santuary - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--<link rel="stylesheet" type="text/css" media="screen" href="main.css">-->
    <style>
        html,
        body {
            background-color: #323A45;
            color: #323A45;
        }

        .nav-item {
            margin-right: 10px;
            margin-left: 10px;
        }

        .nav-item-select:hover, .active {
            border-bottom: 2px solid #323A45;
        }

        .primary-text {
            color: #323A45;
        }

        .secondary-text {
            color: #FFFFF9;
        }

        .card {
            border: none;
        }

        .card:hover {
            box-shadow: 0px 0px 10px #000000;
        }

        a:hover {
            text-decoration: none !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><b class="primary-text">Aston Animal Santuary</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item nav-item-select active">
                        <a class="nav-link" href="#">Adpot a Pet <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item nav-item-select">
                        <a class="nav-link" href="#">Pending Applications</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-nav ml-auto mt-2 mt-lg-0">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">John Doe</a>
                    </li>
                </ul>
                <img src="img/0_200.png" width="40px" />
            </div>
        </div>
    </nav>
    <div class="container secondary-text mt-5">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <p><b>Sort By</b></p>
                    <select class="form-control form-control-sm mb-2">
                        <option value="1"selected>Most Relevant</option>
                        <option value="2">Alphabetical (Ascending)</option>
                        <option value="3">Alphabetical (Descending)</option>
                        <option value="4">Date Added (Ascending)</option>
                        <option value="5">Date Added (Descending)</option>
                    </select>
                    <p><b>Animal Type</b></p>
                    <select class="form-control form-control-sm mb-2">
                        <option value="1" selected>Dog</option>
                        <option value="2">Cat</option>
                        <option value="3">Bird</option>
                        <option value="4">Bunny</option>
                        <option value="5">Hamster</option>
                    </select>
                    <p><b>Animal Breeds</b></p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="breed-checkbox-1">
                        <label class="form-check-label" for="breed-checkbox-1">
                            Border Collie
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="breed-checkbox-2">
                        <label class="form-check-label" for="breed-checkbox-2">
                            Deutschund
                        </label>
                    </div>
                </div>
                <div class="col-10">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-4">
                                <a href="#">
                                    <div class="card">
                                        <img src="https://carepharmaceuticals.com.au/wp-content/uploads/sites/19/2018/02/placeholder-600x400.png" class="card-img-top" alt="...">
                                        <div class="card-body primary-text">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <img src="https://carepharmaceuticals.com.au/wp-content/uploads/sites/19/2018/02/placeholder-600x400.png" class="card-img-top" alt="...">
                                    <div class="card-body primary-text">
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <img src="https://carepharmaceuticals.com.au/wp-content/uploads/sites/19/2018/02/placeholder-600x400.png" class="card-img-top" alt="...">
                                    <div class="card-body primary-text">
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <div class="card">
                                    <img src="https://carepharmaceuticals.com.au/wp-content/uploads/sites/19/2018/02/placeholder-600x400.png" class="card-img-top" alt="...">
                                    <div class="card-body primary-text">
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <img src="https://carepharmaceuticals.com.au/wp-content/uploads/sites/19/2018/02/placeholder-600x400.png" class="card-img-top" alt="...">
                                    <div class="card-body primary-text">
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <img src="https://carepharmaceuticals.com.au/wp-content/uploads/sites/19/2018/02/placeholder-600x400.png" class="card-img-top" alt="...">
                                    <div class="card-body primary-text">
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-4">
                                <div class="card">
                                    <img src="https://carepharmaceuticals.com.au/wp-content/uploads/sites/19/2018/02/placeholder-600x400.png" class="card-img-top" alt="...">
                                    <div class="card-body primary-text">
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <img src="https://carepharmaceuticals.com.au/wp-content/uploads/sites/19/2018/02/placeholder-600x400.png" class="card-img-top" alt="...">
                                    <div class="card-body primary-text">
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <img src="https://carepharmaceuticals.com.au/wp-content/uploads/sites/19/2018/02/placeholder-600x400.png" class="card-img-top" alt="...">
                                    <div class="card-body primary-text">
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>