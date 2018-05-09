var mongoose = require('mongoose');

var Issues = new mongoose.Schema({
	title: { type: String },
	technique: { type: String },
	description:{type:String},
	url:{type:String}
});

mongoose.model('Issues', Issues);
mongoose.connect('mongodb://localhost/');

require('mongoose').model('Issues');

var mongoose = require('mongoose');
var Issues = mongoose.model('Issues');

module.exports = {
  createIssues: function (req, res) {
    var stack = req.body;
    new Issues({ title: stack.title, technique: stack.technique ,description:stack.description,url:stack.url})
      .save(function (err) {
        if (err) {
          res.status(504);
          res.json({'error': err});
        } else {
          res.json({'success': 'Issue Saved Successfully'});
        }
      });
  },
	seeIssues :function (req, res, next) {
    Issues.find({}, function (err, docs) {
      if (err) {
        res.status(504);
        res.json({'error': err});
      } else {
        for (var i = 0; i < docs.length; i++) {
         console.log('issues:', docs[i]);
        }
		res.json( {'success': true , 'data': docs } );
      }
    });
  },
	findissues: function(req, res){
  var stack = req.body;
	console.log(stack,"hello")
	Issues.find({title: new RegExp(stack, 'i')},function(err, result) {
	if (err) {
			res.send(err);
	}else{
	return res.send(result);
		}
	})
},
findtechniquephp:function(req,res){
	var tech = req.body;
	Issues.find({'technique': new RegExp(tech, 'i')},function(err,result){
		if(err){
			res.send(err);
		}else {
			return res.send(result);
		}
	})
}

}
