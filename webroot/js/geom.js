/**
 *
 * geom.js 
 * 
 * author: Pierre Marchand <pierremarc07@gmail.com>
 * 
 * date: 2012-04-16
 * 
 */

window.Geom = window.Geom || {};



// The matrix here is a 3x3 matrix, padded to make the indexing easier to compare with usual numbering in math tutorials

Geom.Matrix = function()
{
    this.m = this.new_m_();
    
}

Geom.Matrix.prototype.new_m_ = function()
{
	var padding = -1;
	return ([[padding],
		[padding, 1,0,0],
		[padding, 0,1,0],
		[padding, 0,0,1]]);
}

Geom.Matrix.prototype.clone_m_ = function(m)
{
	var clone = this.new_m_();
	for (var x = 1; x<4; ++x)
	{
		for (var y = 1; y<4; ++y)
		{
			clone[x][y] = m[x][y];
		}
	}
	return clone;
}

Geom.Matrix.prototype.mul = function(o)
{
    var product = new Geom.Matrix();
    for (var x = 1; x<4; ++x)
    {
        for (var y = 1; y<4; ++y)
        {
                var sum = 0;
                for (var z = 1; z<4; ++z)
                        sum += this.m[x][z] * o.m[z][y];
                product.m[x][y] = sum;
        }
    }
    this.m = product.m;
    return this;
}

Geom.Matrix.prototype.determinant = function()
{
	var min = this.minors(this.m);
	var a = this.m[1][1] * min[1][1];
	var b = this.m[1][2] * min[1][2];
	var c = this.m[1][3] * min[1][3];
	return (a - b + c);
}

Geom.Matrix.prototype.determinant2 = function(a, b , c, d)
{
	return (a * d) - (b * c)
}

Geom.Matrix.prototype.minors = function(m)
{
	var minor11 = this.determinant2(m[2][2], m[2][3], m[3][2], m[3][3]) ;
	var minor12 = this.determinant2(m[2][1], m[2][3], m[3][1], m[3][3]) ;
	var minor13 = this.determinant2(m[2][1], m[2][2], m[3][1], m[3][2]) ;
	var minor21 = this.determinant2(m[1][2], m[1][3], m[3][2], m[3][3]) ;
	var minor22 = this.determinant2(m[1][1], m[1][3], m[3][1], m[3][3]) ;
	var minor23 = this.determinant2(m[1][1], m[1][2], m[3][1], m[3][2]) ;
	var minor31 = this.determinant2(m[1][2], m[1][3], m[2][2], m[2][3]) ;
	var minor32 = this.determinant2(m[1][1], m[1][3], m[2][1], m[2][3]) ;
	var minor33 = this.determinant2(m[1][1], m[1][2], m[2][1], m[2][3]) ; 
	var padding = -1;
	return  [[padding],
		[padding, minor11,minor12,minor13],
		[padding, minor21,minor22,minor23],
		[padding, minor31,minor32,minor33]];
}

Geom.Matrix.prototype.cofactors = function(m)
{
	var c = this.clone_m_(m);
	c[1][2] = m[1][2] * -1;
	c[2][1] = m[2][1] * -1;
	c[2][3] = m[2][3] * -1;
	c[3][2] = m[3][2] * -1;
	return c;
}

Geom.Matrix.prototype.adjugate = function(m)
{
	var a = this.clone_m_(m);
	a[1][2] = m[2][1];
	a[2][1] = m[1][2];
	a[1][3] = m[3][1];
	a[3][1] = m[1][3];
	a[2][3] = m[3][2];
	a[3][2] = m[2][3];
	return a;
}


Geom.Matrix.prototype.inverse = function()
{
	var det = this.determinant();
	// we assume that the matrix is always invertible, so wrong but restful :)
	// well, it would throw an division by 0 exception a bit later, thats it
	var m = this.adjugate(this.cofactors(this.minors(this.m)));
	
	var inverse = new Geom.Matrix();
	for (var x = 1; x<4; ++x)
	{
		for (var y = 1; y<4; ++y)
		{
			inverse.m[x][y] = m[x][y] * (1/det);
		}
	}
	return inverse;
}



Geom.Transform = function()
{
    this.m = new Geom.Matrix(); 
}

Geom.Transform.prototype.inverse = function()
{
	var inverse_m = this.m.inverse();
	var inverse = new Geom.Transform();
	inverse.m = inverse_m;
	return inverse;
}

Geom.Transform.prototype.translate = function(tx,ty)
{
    var transMat = new Geom.Matrix();
    transMat.m[3][1] = tx;
    transMat.m[3][2] = ty;
    this.m.mul(transMat);
    return this;
}

Geom.Transform.prototype.reset_translate = function(x,y)
{
	this.m.m[3][1] = x;
	this.m.m[3][2] = y;
	return this;
}

Geom.Transform.prototype.scale = function(sx, sy, origin)
{
    var scaleMat = new Geom.Matrix();
    if(origin != undefined)
    {
        var tr1 = new Geom.Matrix();
        tr1.m[3][1] = -origin.x;
        tr1.m[3][2] = -origin.y;
        scaleMat.mul(tr1);

        var tr2 = new Geom.Matrix();
        tr2.m[1][1] = sx;
        tr2.m[2][2] = sy;
        scaleMat.mul(tr2);

        var tr3 = new Geom.Matrix();
        tr3.m[3][1] = origin.x;
        tr3.m[3][2] = origin.y;
        scaleMat.mul(tr3);
    }
    else
    {
        scaleMat.m[1][1] = sx;
        scaleMat.m[2][2] = sy;
    }
    this.m.mul(scaleMat);
    return this;
}

Geom.Transform.prototype.mapPoint = function(p)
{
    var rx = p.x * this.m.m[1][1] + p.y * this.m.m[2][1] + this.m.m[3][1];
    var ry = p.x * this.m.m[1][2] + p.y * this.m.m[2][2] + this.m.m[3][2];

    p.x = rx;
    p.y = ry;
}

Geom.Transform.prototype.mapRect = function(r)
{
    var tl = r.topleft();
    var br = r.bottomright();
    this.mapPoint(tl);
    this.mapPoint(br);
    r._x = tl.x;
    r._y = tl.y;
    r._width = br.x - tl.x;
    r._height = br.y - tl.y;
}

Geom.Point = function(x, y)
{
        if((x instanceof Geom.Point) || (x.x && x.y))
        {
                this.x = x.x;
                this.y = x.y;
        }
        else
        {
                this.x = x;
                this.y = y;
        }
}

Geom.Point.prototype.scale = function(sx, sy)
{
        var gsy = sx;
        if(sy != undefined)
                gsy = sy;
        this.x = this.x * sx;
        this.y = this.y * gsy;
        return this;
}

Geom.Point.prototype.delta = function(p)
{
	return (new Geom.Point(p.x - this.x, p.y - this.y)); 
}

Geom.Point.prototype.apply_delta = function(p)
{
	this.x += p.x;
	this.y += p.y;
}

Geom.Point.prototype.toString = function()
{
        return " [ " +this.x + " ; " +this.y + " ] ";
}


Geom.Rect = function(left, top, width, height)
{
        if(left instanceof Geom.Rect)
        {
                this._x = left._x;
                this._y = left._y;
                this._width = left._width;
                this._height = left._height;
        }
        else
        {
                this._x = left;
                this._y = top;
                this._width = width;
                this._height = height;
        }
}

Geom.Rect.prototype.top = function()
{return this._y;}
Geom.Rect.prototype.left = function()
{return this._x;}
Geom.Rect.prototype.width = function()
{return this._width;}
Geom.Rect.prototype.height = function()
{return this._height;}
Geom.Rect.prototype.right = function()
{return this._x + this._width;}
Geom.Rect.prototype.bottom = function()
{return this._y + this._height;}
Geom.Rect.prototype.center = function()
{return (new Geom.Point(this._x + (this._width / 2), this._y + (this._height / 2)));}
Geom.Rect.prototype.topleft = function()
{return (new Geom.Point(this._x , this._y ));}
Geom.Rect.prototype.topright = function()
{return (new Geom.Point(this._x + this._width , this._y ));}
Geom.Rect.prototype.bottomleft = function()
{return (new Geom.Point(this._x , this._y + this._height ));}
Geom.Rect.prototype.bottomright = function()
{return (new Geom.Point(this._x + this._width, this._y + this._height));}
Geom.Rect.prototype.translate = function(dx, dy)
{this._x += dx; this._y += dy;}
Geom.Rect.prototype.move = function(x, y)
{this._x = x; this._y = y;}

Geom.Rect.prototype.intersects = function(r) 
{
    return (
        this.left() <= r.right() 
        && r.left() <= this.right()
        && this.top() <= r.bottom()
        && r.top() <= this.bottom()
    );
}

Geom.Rect.prototype.includes = function(r)
{
    return (
        this.left() <= r.left() 
        && this.right() >= r.right()
        && this.bottom() >= r.bottom()
        && this.top() <= r.top()
    );
}

Geom.Rect.prototype.scale = function(s, o)
{
    var t = new Geom.Transform();
    t.scale(s,s, o);
    t.mapRect(this);
    return this;
}

Geom.Rect.prototype.toString = function()
{
    return '('+this._x+'+'+this._y+' '+this._width+'x'+this._height+')';
}

Geom.Rect.prototype.fitRect = function(rectangle, fill)
{
    var itemRatio = this.height() / this.width();
    var rectRatio = rectangle.height() / rectangle.width();
    var scale = (fill ? itemRatio > rectRatio : itemRatio < rectRatio)
    ? rectangle.width() / this.width()
    : rectangle.height() / this.height();
    
    this.scale(scale);
    var dx = rectangle.center().x - this.center().x;
    var dy = rectangle.center().y - this.center().y;
    this.translate(dx,dy);
    
}

