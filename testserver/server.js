var express = require("express");
var path = require("path");
var fs = require("fs");
var bodyParser = require('body-parser')

var app = express();
app.use( bodyParser.json() );       // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
  extended: true
})); 

app.get("/", function (req, res) {
	res.send("Hello World");
})

app.post("/", function (req, res) {
	res.send("Hello Post");
})

app.post("/data", function (req, res) {
	var params = req.body;
	console.log(req.body);
	res.setHeader("Content-Type", "application/json");
	res.send(JSON.stringify({ params: params }));
})

app.get("/badRequest", function (req, res) {
	res.status(400);
	res.send("Bad request");
})

app.get("/serverError", function (req, res) {
	res.status(500);
	res.send("Server error");
})

app.get("/params", function (req, res) {
	var params = {};
	for (var key in req.query) {
		params[key] = req.query[key]; 
	}
	res.setHeader("Content-Type", "application/json");
	res.send(JSON.stringify({ params: params }));
})
app.get("/attachment", function (req, res) {
	sendFileAsAttachment(res);
})

app.get("/file", function (req, res) {
	res.sendFile(path.join(__dirname, "/", "receipt.pdf"));
})

var server = app.listen(8081, function () {
   var host = server.address().address
   var port = server.address().port
   
   console.log("Mock server listening at http://%s:%s", host, port)
})

function sendFileAsAttachment(res) {
	var filePath = path.join(__dirname, "/", "receipt.pdf");
	var file = fs.createReadStream(filePath, 'binary');
	var stat = fs.statSync(filePath);
	res.setHeader('Content-Length', stat.size);
	res.setHeader('Content-Type', 'application/pdf');
	res.setHeader('Content-Disposition', 'attachment; filename=quote.pdf');
	res.pipe(file, 'binary');
	res.end(); 
}