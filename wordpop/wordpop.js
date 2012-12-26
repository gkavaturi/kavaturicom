//Models, Views, Collections & Controllers :)
(function ($) {
	
var Item=Backbone.Model.extend({
defaults:{
	input_val:"No Input",
	map:{
		"2":{"a1":"a","a2":"b","a3":"c"},
		"3":{"a1":"d","a2":"e","a3":"f"},
		"4":{"a1":"g","a2":"h","a3":"i"},
		"5":{"a1":"j","a2":"k","a3":"l"},
		"6":{"a1":"m","a2":"n","a3":"o"},
		"7":{"a1":"p","a2":"q","a3":"r","a4":"s"},
		"8":{"a1":"t","a2":"u","a3":"v"},
		"9":{"a1":"w","a2":"x","a3":"y","a4":"z"}
		},
	},
//validates the input from users
	validate:function(attributes){
	if ((!(attributes.str))&&(isNaN(attributes.input_val)||attributes.input_val<2||(attributes.input_val.toString().match(/0|1|\./gi)))){
		{
		console.log(attributes);
		return "Please enter a number from 2-9\r Standard Phone Keypad => Alphabet Mapping\r 2: abc\r 3:	def\r 4: ghi\r 5: jkh\r 6: mno\r 7: qrs\r 8: tuv\r 9: wxyz";
		}
		}
	},
	initialize:function(attributes){
	this.bind("error",function(model,error){
		alert(error);
	    return false;
		});
	},
//clears the lists if no results are returned
	clear:function(div){
	$(div).empty();
	}
	

});

var Numbers_Collection = Backbone.Collection.extend({
	initialize:function(model,options){
		this.bind("add",options.view.get_list);
		},
	clear: function(div) {
      this.model.clear(div);
    },
	//matches all the strings based on input value and the input source (text file)
	match_string:function(inputString,str,map,flag){
		 var chars="",matches,patt2,i;
		 for (var k in inputString){
           var temp=map[inputString[k]]["a1"]+"|"+map[inputString[k]]["a2"]+"|"+map[inputString[k]]["a3"];
		   if (map[inputString[k]]["a4"]){
			   temp=temp+"|"+map[inputString[k]]["a4"];
			   }
            matches="("+temp+")";
            chars=chars+matches;
        }
		if (flag==1){
      		patt2=new RegExp('\\s+'+chars+'\\S+','gi');
		}else{
			patt2=new RegExp('\\s('+chars+')\\s','gi');
		}
		str=str.replace(/(\r\n|\n|\r)|,|'|\"|;|:/gm,"");
        i=str.match(patt2);
		return i;
		},	
	select_popular:function(words){
		var wordCounts = { };
		var counter=1;
		var sortable = [];
		for(var i = 0; i < words.length; i++){
			wordCounts[ words[i]] = (wordCounts[words[i]] || 0) + 1;
		}
		for (var count in wordCounts)
		{
			  sortable.push([count, wordCounts[count]]);
		 	  counter++;
		}
		sortable.sort(function(a, b) {return a[1] - b[1]});
		sortable.reverse();
		sortable.length=5;
		//console.log(sortable);
		return sortable;
		},
	//helper function to show if no results are returned	
	no_result:function(div){
		$(div).append("<tr><td>No Results</td></tr>");
		},
	//function to show results onto the list
	output_list:function(div,matched){
		$(div).append("<tr><th>Prefix-Word</th><th>Popularity</th></tr>");
		for (var temp in matched)
			$(div).append("<tr><td>"+matched[temp][0]+"</td><td>"+matched[temp][1]+"</td></tr>");
		}
	});

var List=new Numbers_Collection(null,{view:this});

var AppView = Backbone.View.extend({
    el: $("#match-list"),
	initialize:function(){
			this.numbers_collection=new Numbers_Collection(null,{view:this});
		},
    events: {
      "click #input_number":"search_input",
	  "keypress #input_txt":"search_enter",
    },
	search_enter:function(){
		if (event.keyCode==13){
			this.search_input();
			}
		},
    search_input: function () {
      this.input=this.$("#input_txt");
	  var list_model=new Item();
	  if (!list_model.set({input_val:this.input.val()})) return; 
	  this.numbers_collection.add(list_model);
    },
	get_list:function(model){
		//loading text file contents from main page div. faster than $.get and requires no wait for large files
		var str=$("#text-body").html();
		model.clear(".result-class");
		var	list_result=model.get('input_val');
		var map=model.get('map');
		//processing prefix case matches
		var matched=List.match_string(list_result,str,map,1);;
		if (matched==null) 
			{
				List.no_result("#result-list");
				List.no_result("#result-list-2");
				return;
			}
		matched=List.select_popular(matched);
		List.output_list("#result-list",matched);
		//processing exact case matches
		matched=List.match_string(list_result,str,map,2);;
		if (matched==null) 
			   { 
			   List.no_result("#result-list-2");	
			   return; 
			   }
		matched=List.select_popular(matched);	
		List.output_list("#result-list-2",matched);
		},
	upload_click:function(){
		$('#file').click();
		},
	upload_file:function(model){
		if ($('#file').val()){
			$('#uform').submit();
			}
		},
  });
var appview=new AppView;
  })(jQuery);
	