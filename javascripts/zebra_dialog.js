;
(function(c){
    c.Zebra_Dialog=function(g,j){
        var o={
            animation_speed:250,
            auto_close:!1,
            buttons:!0,
            custom_class:!1,
            keyboard:!0,
            message:"",
            modal:!0,
            overlay_close:!0,
            overlay_opacity:0.9,
            position:"center",
            title:"",
            type:"information",
            vcenter_short_message:!0,
            width:0,
            onClose:null
        },
        a=this;
        a.settings={};
        
        options={};
        
        "string"==typeof g&&(options.message=g);
        if("object"==typeof g||"object"==typeof j)options=c.extend(options,"object"==typeof g?g:j);
        a.init=function(){
            a.settings=c.extend({},o,options);
            a.isIE6=c.browser.msie&& parseInt(c.browser.version,10)==6||false;
            if(a.settings.modal)

            {
                a.overlay=jQuery("<div>",{
                    "class":"ZebraDialogOverlay"
                }).css({
                    position:a.isIE6?"absolute":"fixed",
                    left:0,
                    top:0,
                    opacity:a.settings.overlay_opacity,
                    "z-index":1E3
                });
                a.settings.overlay_close&&a.overlay.bind("click",function(){
                    a.close()
                    });
                a.overlay.appendTo("body")
                }
            a.dialog=jQuery("<div>",{
                "class":"ZebraDialog"+(a.settings.custom_class?" "+a.settings.custom_class:"")
                }).css({
                position:a.isIE6?"absolute":"fixed",
                left:0,
                top:0,
                "z-index":1001,
                visibility:"hidden"
            });
            !a.settings.buttons&&a.settings.auto_close&&a.dialog.attr("id","ZebraDialog_"+Math.floor(Math.random()*9999999));
            var b=parseInt(a.settings.width);
            !isNaN(b)&&b==a.settings.width&&b.toString()==a.settings.width.toString()&&b>0&&a.dialog.css({
                width:a.settings.width
                });
            a.settings.title&&jQuery("<h3>",{
                "class":"ZebraDialog_Title"
            }).html(a.settings.title).appendTo(a.dialog);
            a.message=jQuery("<div>",{
                "class":"ZebraDialog_Body"+(k()!=""?" ZebraDialog_Icon ZebraDialog_"+k():"")
                });
            a.settings.vcenter_short_message? jQuery("<div>").html(a.settings.message).appendTo(a.message):a.message.html(a.settings.message);
            a.message.appendTo(a.dialog);
            if(a.settings.buttons!==true&&!c.isArray(a.settings.buttons))
                b=false;
            else{
                if(a.settings.buttons===true)switch(a.settings.type){
                    case "question":
                        a.settings.buttons=["Yes","No"];
                        break;
                    default:
                        a.settings.buttons=["Ok"]
                        }
                        b=a.settings.buttons.reverse()
                }
                if(b){
                var d=jQuery("<div>",{
                    "class":"ZebraDialog_Buttons"
                }).appendTo(a.dialog);
                c.each(b,function(b,e){
                    var h=jQuery("<a>",

                    {
                        href:"javascript:void(0)", 
                        "class":"ZebraDialog_Button"+b
                        });
                    c.isPlainObject(e)?h.html(e.caption):h.html(e);
                    h.bind("click",function(){
                        void 0!=e.callback&&e.callback(a.dialog);
                        a.close(void 0!=e.caption?e.caption:e)
                        });
                    h.appendTo(d)
                    });
                jQuery("<div>",{
                    style:"clear:both"
                }).appendTo(d)
                }
                a.dialog.appendTo("body");
            c(window).bind("resize",i);
            a.settings.keyboard&&c(document).bind("keyup",l);
            a.isIE6&&c(window).bind("scroll",m);
            if(a.settings.auto_close!==false){
                a.dialog.bind("click",function(){
                    clearTimeout(a.timeout);
                    a.close()
                    });
                a.timeout= setTimeout(a.close,
                    a.settings.auto_close)
                }
                i();
            return a
            };
            
        a.close=function(b){
            a.settings.keyboard&&c(document).unbind("keyup",l);
            a.isIE6&&c(window).unbind("scroll",m);
            c(window).unbind("resize",i);
            a.overlay&&a.overlay.animate({
                opacity:0
            },a.settings.animation_speed,function(){
                a.overlay.remove()
                });
            a.dialog.animate({
                top:0,
                opacity:0
            },
            a.settings.animation_speed,function(){
                a.dialog.remove();
                if(a.settings.onClose&&typeof a.settings.onClose=="function")a.settings.onClose(void 0!=b?b:"")
                    })
            };
        var i=function(){
            var b= c(window).width(),d=c(window).height(),f=a.dialog.width(),e=a.dialog.height(),f={
                left:0,
                top:0,
                right:b-f,
                bottom:d-e,
                center:(b-f)/2,
                middle:(d-e)/2
                };
            a.dialog_left=void 0;
            a.dialog_top=void 0;
            a.settings.modal&&a.overlay.css({
                width:b,
                height:d
            });
            if(c.isArray(a.settings.position)&&a.settings.position.length==2&&typeof a.settings.position[0]=="string"&&a.settings.position[0].match(/^(left|right|center)[\s0-9\+\-]*$/)&&typeof a.settings.position[1]=="string"&&a.settings.position[1].match(/^(top|bottom|middle)[\s0-9\+\-]*$/)){
                a.settings.position[0]= a.settings.position[0].toLowerCase();
                a.settings.position[1]=a.settings.position[1].toLowerCase();
                c.each(f,function(b,c){
                    for(var d=0;d<2;d++){
                        var e=a.settings.position[d].replace(b,c);
                        if(e!=a.settings.position[d])d==0?a.dialog_left=eval(e):a.dialog_top=eval(e)
                            }
                        })
            }
            if(void 0==a.dialog_left||void 0==a.dialog_top){
            a.dialog_left=f.center;
            a.dialog_top=f.middle
            }
            if(a.settings.vcenter_short_message){
            b=a.message.find("div:first");
            d=b.height();
            f=a.message.height();
            d<f&&b.css({
                "margin-top":(f-d)/2
                })
            }
            a.dialog.css({
            left:a.dialog_left, 
            top:a.dialog_top,
            visibility:"visible"
        });
        a.dialog.find("a[class^=ZebraDialog_Button]:first").focus();
        a.isIE6&&setTimeout(n,500)
        },n=function(){
        var b=c(window).scrollTop(),d=c(window).scrollLeft();
        a.settings.modal&&a.overlay.css({
            top:b,
            left:d
        });
        a.dialog.css({
            left:a.dialog_left+d,
            top:a.dialog_top+b
            })
        },k=function(){
        switch(a.settings.type){
            case "confirmation":case "error":case "information":case "question":case "warning":
                return a.settings.type.charAt(0).toUpperCase()+a.settings.type.slice(1).toLowerCase();
            default:
                return false
                }
            },l=function(b){
    b.which==27&&a.close();
    return true
    },m=function(){
    n()
    };
    
return a.init()
    }
})(jQuery);