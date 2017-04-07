$(function(){
  init_images();
  $(".like_btn").click(function(){
    like_dislike(this);
  });
  $(".dislike_btn").click(function(){
    like_dislike(this);
  });
});

function get_table_cell(image_id, like_count, dislike_count,like_status){
  var button_class = ["btn-default","btn-default"];
  if(like_status ==1){
    button_class[0] = "btn-success";
  }
  else if (like_status==-1) {
    button_class[1] = "btn-danger";
  }

  var template_col='<td> <div id="'+image_id+'" class="gallery">'+
      '<img class="img-rounded" src="/static/art/'+ image_id+'.jpg" alt="" width="300" height="200">'+
      '<div class="desc">'+
        '<button type="buton" class="btn '+ button_class[0]+ ' like_btn">'+
          '<span class="glyphicon glyphicon-thumbs-up">'+ like_count+
          '</span>'+
        '</button>'+
        '<button type="button" class="btn '+ button_class[1]+' dislike_btn">'+
          '<span class="glyphicon glyphicon-thumbs-down">'+ dislike_count+
          '</span>'+
        '</button><br>'+
      '</div>'+
  '</div></td>';
  return template_col;
}

function init_images(){
  console.log(image_ids.length);
  var result = "";
  for(var i=0; i< (image_ids.length)/3; i++){
    var temp_tr="<tr>";
    for(var j=0; j<3; j++){
      if(i*3 +j< image_ids.length){
        temp_tr += get_table_cell(image_ids[i*3 + j],like_counts[i*3 + j],dislike_counts[i*3 + j],like_status[i*3 + j] );
      }
    }
    temp_tr +="</tr>";
    result += temp_tr;
  }
  $("#images-table > tbody").append(result);
}

function buttons_class(image_id, last_like_status, like_cnt, dislike_cnt){
  var buttons = $("#"+image_id+" > .desc>button") ;
  buttons[0] = $(buttons[0]);
  buttons[1] = $(buttons[1]);
  if(last_like_status == 1){
      buttons[0].attr("class", "btn btn-success like_btn");
      buttons[1].attr("class","btn btn-default dislike_btn");
  }
  else if(last_like_status == -1){
    buttons[0].attr("class","btn btn-default like_btn");
    buttons[1].attr("class","btn btn-danger dislike_btn");
  }
  else{
    buttons[0].attr("class","btn btn-default like_btn");
    buttons[1].attr("class","btn btn-default dislike_btn");
  }
  $(buttons[0]).find("span").text(like_cnt);
  $(buttons[1]).find("span").text(dislike_cnt);
}

function like_dislike(event){
  var photo_id=parseInt($(event).parent().parent().attr("id"));
  var photo_index = image_ids.indexOf(photo_id);
  var is_like = $(event).attr("class");
  if(is_like.includes("dislike")){
    is_like = 0;
    var the_image_point = like_status[photo_index];
    if(the_image_point ==1){
      dislike_counts[photo_index]++;
      like_counts[photo_index]--;
      like_status[photo_index] =-1;
    }
    else if(the_image_point==0){
      dislike_counts[photo_index]++;
      like_status[photo_index] =-1;
    }
    else{
      like_status[photo_index] =0;
      dislike_counts[photo_index]--;
    }

  }
  else{
    is_like = 1;
    var the_image_point = like_status[photo_index];
    if(the_image_point ==1){
      like_status[photo_index] =0;
      like_counts[photo_index]--;
    }
    else if(the_image_point==0){
      like_counts[photo_index]++;
      like_status[photo_index] =1;
    }
    else{
      like_counts[photo_index]++;
      dislike_counts[photo_index]--;
      like_status[photo_index] =1;
    }
  }

  console.log();
  buttons_class(photo_id, like_status[photo_index], like_counts[photo_index],dislike_counts[photo_index]);

}
