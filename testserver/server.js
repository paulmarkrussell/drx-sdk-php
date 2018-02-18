var express = require('express');
var app = express();

app.get('/', function (req, res) {
	res.send('Hello World');
})

app.get('/badRequest', function (req, res) {
	res.status(400);
	res.send('Bad request');
})

app.get('/serverError', function (req, res) {
	res.status(500);
	res.send('Server error');
})

app.get('/params', function (req, res) {
	var params = {};
	for (var key in req.query) {
		console.log(key);
		console.log(req.query[key]);
		params[key] = req.query[key]; 
	}
	res.setHeader('Content-Type', 'application/json');
	res.send(JSON.stringify({ params: params }));
})

var server = app.listen(8081, function () {
   var host = server.address().address
   var port = server.address().port
   
   console.log("Example app listening at http://%s:%s", host, port)
})