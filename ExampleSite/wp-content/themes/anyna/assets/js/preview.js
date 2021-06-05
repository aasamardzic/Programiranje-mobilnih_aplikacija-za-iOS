!function( customize ){
    function Colors(){
        function ColorToArray( rgb ){
            var _rgb;
            if( typeof rgb == 'string' ){
                rgb = rgb.replace( /\s/g );
                if( rgb.indexOf( '#' ) == 0 ){
                    let c1 = parseInt( rgb.slice( 1 , 3 ) , 16 );
                    let c2 = parseInt( rgb.slice( 3 , 5 ) , 16 );
                    let c3 = parseInt( rgb.slice( 5 , 7 ) , 16 );
                    _rgb = [ c1 , c2 , c3 ];
                }
                else
                    _rgb = rgb.replace( /rgba|rgb|\(|\)/g , '' ).split(',');
            }
            for( let i = 0 ; i < _rgb.length ; i++ ){
                if( i == 3 ){
                    let v = parseFloat( _rgb[3] );
                    if( _rgb[3] == null || _rgb[3] == '' || isNaN( v ) )
                        _rgb[3] = 1;
                    else{
                        v = v < 0 ? 0 : v;
                        v = v > 1 ? 1 : v;
                        _rgb[3] = v;
                    }
                }
                else{
                    let v = parseInt( _rgb[i] );
                    v = v < 0 ? 0 : v;
                    v = v > 255 ? 255 : v;
                    _rgb[i] = v;
                }
            }
            return _rgb;
        }
        function _getColor( color_1 , color_2 , offset ){
            var _color_1 = ColorToArray( color_1 );
            var _color_2 = ColorToArray( color_2 );
            var _color_r = [];
            offset = Number( offset );
            offset = isNaN( offset )? 0 : offset;
            offset = offset > 100 ? 100 : offset;
            offset = offset < -100 ? -100 : offset;
            for( let i = 0 ; i < 3 ; i++ ){
                _color_r[i] = _color_1[i] + Math.floor( Math.abs( _color_1[i] - _color_2[i] )*offset/100 );
            }
            var color_r = _color_r[0]+','+_color_r[1]+','+_color_r[2];
            if( _color_1[3] >= 0 && _color_1[3] <= 1 )
                color_r = 'rgba(' + color_r + ',' + _color_1[3] + ')';
            else
                color_r = 'rgb(' + color_r + ')';
            return color_r;
        }
        function getColor( color , offset ){
            if( offset >= 0 )
                return _getColor( color , 'rgb(255,255,255)' , offset );
            else
                return _getColor( color , 'rgb(0,0,0)' , offset );
        }
        return getColor;
    }
    var getColor = Colors();
    function StyleManager(){
        var _values = {};
        var style_element = document.createElement( 'style' );
        document.head.appendChild( style_element );
        function change( name , value ){
            _values[ name ] = value;
            style_element.textContent = createStyle( name , value );
        }
        var _style_handlers = {
            color_1 : function(){
                var str = '';
                this.createStyle = function( value ){
                    var color_1 = value;
                    str = '';
                    str += '--color-0: ' + getColor( color_1 , -67 ) + ';\n';
                    str += '--color-1: ' + getColor( color_1 , -50 ) + ';\n';
                    str += '--color-2: ' + getColor( color_1 , -43 ) + ';\n';
                    str += '--color-3: ' + getColor( color_1 , -35 ) + ';\n';
                    str += '--color-4: ' + getColor( color_1 , -20 ) + ';\n';
                    str += '--color-5: ' + getColor( color_1 , 0 ) + ';\n';
                    str += '--color-6: ' + getColor( color_1 , 40 ) + ';\n';
                    str += '--color-7: ' + getColor( color_1 , 55 ) + ';\n';
                    str += '--color-8: ' + getColor( color_1 , 70 ) + ';\n';
                    str += '--color-9: ' + getColor( color_1 , 90 ) + ';\n';
                    str = ':root{\n' + str + '}\n';
                    return str;
                };
                this.getStyle = function(){
                    return str;
                };
            },
            margin_1 : function(){
                var str = '';
                this.createStyle = function( value ){
                    str = '';
                    str += 'margin-top: ' + value + 'px;\n';
                    str += 'margin-bottom: ' + value + 'px;\n';
                    str = '.site{\n' + str + '\n}\n';
                    return str;
                };
                this.getStyle = function(){
                    return str;
                };
            },
            margin_2 : function(){
                var str = '';
                this.createStyle = function( value ){
                    str = '';
                    str += 'margin-left: ' + value + 'px;\n';
                    str += 'margin-right: ' + value + 'px;\n';
                    str = '.site{\n' + str + '\n}\n';
                    return str;
                };
                this.getStyle = function(){
                    return str;
                };
            },
            'sidebar-left_width' : function(){
                var str = '';
                this.createStyle = function( value ){
                    str = '';
                    str += 'width: ' + value + 'px;\n';
                    str += 'margin-left: -' + value + 'px;\n';
                    str = '[sidebar=main-left]{\n' + str + '\n}\n';
                    str += '#center.has-left-sidebar{\n padding-left: ' + value + 'px;\n}\n';
                    return str;
                };
                this.getStyle = function(){
                    return str;
                };
            },
            'sidebar-right_width' : function(){
                var str = '';
                this.createStyle = function( value ){
                    str = '';
                    str += 'width: ' + value + 'px;\n';
                    str += 'margin-right: -' + value + 'px;\n';
                    str = '[sidebar=main-right]{\n' + str + '\n}\n';
                    str += '#center.has-right-sidebar{\n padding-right: ' + value + 'px;\n}\n';
                    return str;
                };
                this.getStyle = function(){
                    return str;
                };
            }
        };
        var _style_objects = {};
        for( let x in _style_handlers ){
            let f = _style_handlers[ x ];
            if( typeof f == 'function' ){
                _style_objects[ x ] = new f();
            }
        }
        function createStyle( name , value ){
            var str = '';
            for( let x in _style_objects ){
                if( x == name ){
                    str += _style_objects[ x ].createStyle( value );
                }
                else{
                    str += _style_objects[ x ].getStyle();
                }
            }
            return str;
        }
        return change;
    }
    var changeStyle = StyleManager();
    function Setting( name ){
        customize( name , function( setting ){
            setting.bind( function( value ){
                changeStyle( name , value );
            });
        });
    }
    Setting( 'color_1' );
    Setting( 'margin_1' );
    Setting( 'margin_2' );
    Setting( 'sidebar-left_width' );
    Setting( 'sidebar-right_width' );
}( wp.customize );