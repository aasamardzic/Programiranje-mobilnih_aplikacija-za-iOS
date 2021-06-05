!function(){
    var is_mobile = 0;
    function isMobile(){
        if( is_mobile === 0 )
            if( /mobile|Android|webOS|iPhone|iPad|Mac|Macintosh|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                is_mobile = 1;
            }
            else
                is_mobile = -1;
        return is_mobile === 1;
    }
    function MenuManager( element , get_menu_element , get_sub_menu_element , get_item_element , Effects , mobile_mode_effects ){
        var mobile_mode;
        function isMobileMode(){
            var element = document.querySelector( '.site>.mobile-mode' );
            if( element instanceof HTMLElement ){
                let css = window.getComputedStyle( element , null );
                return css.visibility == 'visible';
            }
            return false;
        }
        function Menu( element ){
            var e_target;
            function Menu( element , item  , parent_menu ){
                var items = [] , menu = this , current_item;
                function Item( element ){
                    var sub_menu , item = this;
                    function createMenu( element ){
                        if( element instanceof HTMLElement ){
                            sub_menu = new Menu( element , item , menu );
                        }
                    }
                    get_sub_menu_element( element , createMenu );
                    function Events(){
                        var show_handler , hide_handler , linkelement;
                        for( let i = 0 ; i < element.children.length ; i++ ){
                            if( element.children[ i ].tagName == 'A' ){
                                linkelement = element.children[ i ];
                                break;
                            }
                        }
                        this.onShow = function( handler ){
                            show_handler = handler;
                        };
                        this.onHide = function( handler ){
                            hide_handler = handler;
                        };
                        element.addEventListener( 'mouseover' , function( event ){
                            if( typeof show_handler == 'function' )
                                show_handler( event );
                        });
                        element.addEventListener( 'mouseout' , function( event ){
                            if( typeof hide_handler == 'function' )
                                hide_handler( event );
                        });
                        linkelement.addEventListener( 'focus' , function( event ){
                            event.clientY = offset( 'Top' , element );
                            event.clientX = offset( 'Left' , element );
                            if( typeof show_handler == 'function' )
                                show_handler( event );
                            if( menu instanceof Object )
                                menu.show();
                        });
                        linkelement.addEventListener( 'blur' , function( event ){
                            if( typeof hide_handler == 'function' )
                                hide_handler( event );
                            menu.blur();
                        });
                    }
                    this.show = function(){

                    };
                    this.hide = function( delay ){
                        if( sub_menu instanceof Object )
                            sub_menu.hide( delay );
                    };
                    var events = new Events();
                    events.onShow( function( event ){
                        if( sub_menu instanceof Object ){
                            if( current_item instanceof Object && current_item != item )
                                current_item.hide( 0 );
                            sub_menu.show( event , element );
                            current_item = item;
                        }
                    } );
                    events.onHide( function( event ){
                        if( sub_menu instanceof Object )
                            sub_menu.hide();
                    } );
                }
                function createItem( element ){
                    if( element instanceof HTMLElement ){
                        items.push( new Item( element ) );
                    }
                }
                get_item_element( element , createItem );
                function _Effects(){
                    var mobile_effects = {} , effects = {} ;
                    if( typeof mobile_mode_effects == 'function' ){
                        mobile_effects = new mobile_mode_effects( element );
                    }
                    if( typeof Effects == 'function' ){
                        effects = new Effects( element );
                    }
                    this.show = function(){
                        var f;
                        if( isMobileMode() ){
                            f = mobile_effects.show;
                        }
                        else{
                            f = effects.show;
                        }
                        if( typeof f == 'function' )
                            f.apply( null , arguments );
                    };
                    this.hide = function(){
                        var f;
                        if( isMobileMode() ){
                            f = mobile_effects.hide;
                        }
                        else{
                            f = effects.hide;
                        }
                        if( typeof f == 'function' )
                            f.apply( null , arguments );
                    };
                }
                var effects = new _Effects();
                function location( e , item_element ){
                    if( !( e instanceof Object && item_element instanceof HTMLElement ) )
                        return;
                    if( element.contains( e.target ) || element === e.target ) return;
                    var width = element.offsetWidth;
                    var height = element.offsetHeight;
                    var css = window.getComputedStyle( item_element , null );
                    var inline_block = css.getPropertyValue( 'display' ) == 'inline-block';
                    var s = element.style;
                    var cX = e.clientX;
                    var _cX = window.innerWidth - e.clientX;
                    var cY = e.clientY;
                    var _cY = window.innerHeight - e.clientY;
                    var fs;
                    function _calls( list , fs ){
                        if( !Array.isArray( list ) )return;
                        for( let i = 0 ; i < list.length ; i++ ){
                            let f = fs[ list[ i ] ];
                            if( typeof f == 'function' )
                                if( f() === true ) return true;
                        }
                    }
                    if( inline_block ){
                        fs = {
                            'x' : {
                                'right' : function(){
                                    if( _cX > width ){
                                        s.left = '0px';
                                        s.right = '';
                                        return true;
                                    }
                                },
                                'left' : function(){
                                    if( cX > width ){
                                        s.left = '';
                                        s.right = '0px';
                                        return true;
                                    }
                                },
                                'default' : function(){
                                    s.left = '-' + String( width - _cX ) + 'px';
                                    s.right = '';
                                }
                            },
                            'y' : {
                                'bottom' : function(){
                                    if( _cY > item_element.offsetHeight + height ){
                                        s.top = '100%';
                                        s.bottom = '';
                                        return true;
                                    }
                                },
                                'top' : function(){
                                    if( cY > item_element.offsetHeight + height ){
                                        s.top = '';
                                        s.bottom = '100%';
                                        return true;
                                    }
                                },
                                'default' : function(){
                                    s.top = '100%';
                                    s.bottom = '';
                                }
                            }
                        };
                        _calls( arrayX , fs[ 'x' ] );
                        _calls( [ 'bottom' , 'top' , 'default' ] , fs[ 'y' ] );
                    }
                    else{
                        fs = {
                            'x' : {
                                'right' : function(){
                                    if( _cX > item_element.offsetWidth + width ){
                                        s.left = '100%';
                                        s.right = '';
                                        return true;
                                    }
                                },
                                'left' : function(){
                                    if( cX > item_element.offsetWidth + width ){
                                        s.left = '';
                                        s.right = '100%';
                                        return true;
                                    }
                                },
                                'default' : function(){
                                    s.left = '100%';
                                    s.right = '';
                                }
                            },
                            'y' : {
                                'bottom' : function(){
                                    if( _cY > height ){
                                        s.top = '0px';
                                        s.bottom = '';
                                        return true;
                                    }
                                },
                                'top' : function(){
                                    if( cY > height ){
                                        s.top = '';
                                        s.bottom = '0px';
                                        return true;
                                    }
                                },
                                'default' : function(){
                                    s.top = '0px';
                                    s.bottom = '';
                                }
                            }
                        };
                        _calls( arrayX , fs[ 'x' ] );
                        _calls( [ 'bottom' , 'top' , 'default' ] , fs[ 'y' ] );
                    }
                }
                var storage = {};
                this.getValue = function( key ){
                    return storage[ key ];
                }
                function set_hidden(){
                    element.style.visibility = 'hidden';
                    element.style.display = 'none';
                }
                function show( event , item_element ){
                    if( parent_menu != null )
                        parent_menu.show();
                    clearTimeout( storage.hide_timeout );
                    element.removeEventListener( 'transitionend' , set_hidden );
                    element.style.display = 'block';
                    function show(){
                        if( storage.visible === true ) return;
                        storage.visible = true;
                        location( event , item_element );
                        element.style.visibility = 'visible';
                        element.classList.add( 'show' );
                        element.classList.remove( 'hide' );
                        effects.show();
                    }
                    clearTimeout( storage.show_timeout );
                    storage.show_timeout = setTimeout( show , 10 );
                }
                function hide( delay ){
                    clearTimeout( storage.show_timeout );
                    function hide(){
                        if( storage.visible === false ) return;
                        storage.visible = false;
                        element.classList.add( 'hide' );
                        element.classList.remove( 'show' );
                        effects.hide();
                        element.addEventListener( 'transitionend' , set_hidden );
                    }
                    clearTimeout( storage.hide_timeout );
                    if( delay == null )
                        delay = 500;
                    storage.hide_timeout = setTimeout( hide , delay );
                }
                this.show = function( event , item_element ){
                    show( event , item_element );
                }
                this.hide = function( delay ){
                    hide( delay );
                }
                this.focus = function(){

                }
                this.blur = function(){
                    if( element.contains( e_target ) ) return;
                    menu.hide();
                    if( parent_menu instanceof Object )
                        parent_menu.blur();
                }
            }
            document.body.addEventListener( 'mousemove' , function( e ){
                e_target = e.target;
            });

            var offsetX = offset( 'Left' , element );
            var offsetY = offset( 'Top' , element );
            var arrayX , arrayY;
            var _arrayX_right = [ 'right' , 'left' , 'default' ];
            var _arrayX_left = [ 'left' , 'right' , 'default' ];
            function array_calls(){
                if( offsetX + element.offsetWidth < window.innerWidth / 2 ){
                    arrayX = _arrayX_right;
                }
                else if( offsetX > window.innerWidth / 2 ){
                    arrayX = _arrayX_left;
                }
                else
                    arrayX = _arrayX_right;
            }
            array_calls();

            var root_menu = new Menu( element );
            root_menu.hide = function(){};
            root_menu.show = function(){};
            return root_menu;
        }
        var menus = [];
        function createMenu( element ){
            if( element instanceof HTMLElement ){
                menus.push( Menu( element ) );
            }
        }
        function offset( z , el ){
            if( !( el instanceof HTMLElement ) )return null;
            var x = 0;
            while( !( el === document.body ) && el != null ){
                x += el[ 'offset' + z ] + el.offsetParent[ 'client' + z ];
                el = el.offsetParent;
            }
            return x;
        }
        if( !( element instanceof HTMLElement ) )
            element = document.body;
        get_menu_element( element , createMenu );
    }
    window.addEventListener('load', function(){
        function MobileMode(){
            function isMobileMode(){
                var element = document.querySelector( '.site>.mobile-mode' );
                if( element instanceof HTMLElement ){
                    let css = window.getComputedStyle( element , null );
                    return css.visibility == 'visible';
                }
                return false;
            }
            function check(){
                if( isMobileMode() )
                    document.body.classList.add( 'mobile' );
                else
                    document.body.classList.remove( 'mobile' );
            }
            check();
            window.addEventListener( 'resize' , check );
        }
        MobileMode();
        function Effects( element ){
            var v_interval , show_status , hide_timeout;
            function setHeight(){
                element.style.height = element.scrollHeight + 'px';
            }
            this.show = function(){
                if( show_status == true && element.style.height == 'auto' )
                    return;
                clearTimeout( hide_timeout );
                show_status = true;
                setHeight();
                clearInterval( v_interval );
                v_interval = setInterval( setHeight , 100 );
            };
            this.hide = function(){
                clearInterval( v_interval );
                show_status = false;
                setHeight();
                clearTimeout( hide_timeout );
                hide_timeout = setTimeout( function(){
                    element.style.height = '';
                } , 10 );
            };
            element.addEventListener( 'transitionend' , function(){
                clearInterval( v_interval );
                if( show_status == true )
                    element.style.height = 'auto';
            });
        }
        MenuManager( null , function( element , handler ){
            var elements = element.querySelectorAll( '.header ul.menu , .header .menu>ul , #main ul.menu , #main .menu>ul' );
            for( let i = 0 ; i < elements.length ; i++ ){
                handler( elements[ i ] );
            }
        },function( element , handler ){
            var elements = element.children;
            for( let i = 0 ; i < elements.length ; i++ ){
                if( elements[ i ].tagName == 'UL' ){
                    handler( elements[ i ] );
                    return;
                }
            }
        },function( element , handler ){
            var elements = element.children;
            for( let i = 0 ; i < elements.length ; i++ ){
                if( elements[ i ].tagName == 'LI' )
                    handler( elements[ i ] );
            }
        } , null , Effects );
        MenuManager( null , function( element , handler ){
            var elements = element.querySelectorAll( '.widget_pages>ul,.wp-block-page-list' );
            for( let i = 0 ; i < elements.length ; i++ ){
                handler( elements[ i ] );
            }
        },function( element , handler ){
            var elements = element.children;
            for( let i = 0 ; i < elements.length ; i++ ){
                if( elements[ i ].tagName == 'UL' ){
                    handler( elements[ i ] );
                    return;
                }
            }
        },function( element , handler ){
            var elements = element.children;
            for( let i = 0 ; i < elements.length ; i++ ){
                if( elements[ i ].tagName == 'LI' )
                    handler( elements[ i ] );
            }
        },Effects,Effects);
    });
}();