
dynamic class com.utilities.DynamicRegistration {
	
	private function DynamicRegistration() {
		
	}
	// initialize the class (set target)
	public static function initialize(target_mc):Void {
		var p = _global.com.utilities.DynamicRegistration.prototype;
		target_mc.xreg = 0;
		target_mc.yreg = 0;
		target_mc.setRegistration = p.setRegistration;
		target_mc.setPropRel = p.setPropRel;
		// properties to add to the MC
		with (target_mc) {
			addProperty("_x2", p.get_x2, p.set_x2);
			addProperty("_y2", p.get_y2, p.set_y2);
			addProperty("_xscale2", p.get_xscale2, p.set_xscale2);
			addProperty("_yscale2", p.get_yscale2, p.set_yscale2);
			addProperty("_rotation2", p.get_rotation2, p.set_rotation2);
			addProperty("_xmouse2", p.get_xmouse2, null);
			addProperty("_ymouse2", p.get_ymouse2, null);
			//
			addProperty("_allscale2", p.get_yscale2, p.set_allscale2);
		}
		
	}
	// function that changes the point registration of the MC
	private function setRegistration(x:Number, y:Number):Void {
		this.xreg = x;
		this.yreg = y;
	}
	
	private function get_x2():Number {
		var a = {x:this.xreg, y:this.yreg};
 		this.localToGlobal(a);
		this._parent.globalToLocal(a);
 		return a.x;
	}
	
	private function set_x2(value:Number):Void {
		var a = {x:this. xreg, y:this. yreg};;
		this.localToGlobal(a);
		this._parent.globalToLocal(a);
		this._x += value - a.x;
	}

	private function get_y2():Number {
		var a = {x:this.xreg, y:this.yreg};
 		this.localToGlobal(a);
		this._parent.globalToLocal(a);
 		return a.y;
	}
	
	private function set_y2(value:Number):Void {
		var a = {x:this.xreg, y:this.yreg};
		this.localToGlobal(a);
		this._parent.globalToLocal(a);
		this._y += value - a.y;
	}
	// function used to scale _x & _y of the MC initialized 
	private function set_allscale2(value:Number):Void {
		this.setPropRel("_xscale", value);
		this.setPropRel("_yscale", value);
	}
	
	private function set_xscale2(value:Number):Void {
		this.setPropRel("_xscale", value);
	}
	
	private function get_xscale2():Number {
		return this._xscale;
	}
	
	private function set_yscale2(value:Number):Void {
		this.setPropRel("_yscale", value);
	}
	
	private function get_yscale2():Number {
		return this._yscale;
	}
	
	private function set_rotation2(value:Number):Void {
		this.setPropRel("_rotation", value);
	}
	
	private function get_rotation2():Number {
		return this._rotation;
	}
	
	private function get_xmouse2():Number {
		return this._xmouse - this.xreg;
	}
	
	private function get_ymouse2():Number {
		return this._ymouse - this.yreg;
	}

	private function setPropRel(property:String, amount:Number):Void {
		// we dont let the MC scale less than 15%
		trace("HACE RESIZE:"+amount);
		if (amount>45) {
		//if (amount>15) {
			var a = {x:this.xreg, y:this.yreg};
			this.localToGlobal (a);
			this._parent.globalToLocal (a);
			this[property] = amount;
			var b = {x:this.xreg, y:this.yreg};
			this.localToGlobal (b);
			this._parent.globalToLocal (b);
			this._x -= b.x - a.x;
			this._y -= b.y - a.y;
			
			// check boundary
			      var right=this._width+this._x;
			      var left=this._x;
			       var top=this._y;
			      var bottom=this._height+this._y;
			
		     // if (right<400) {
			 if (right<500) {
			       //var boundaryright_diff=this._width+this._x-400;
				 var boundaryright_diff=this._width+this._x-500;
				//this._x=-(this._width-401);
				 this._x=-(this._width-501);
	       
		       }		       
		       if (top>0) {
			       this._y=  0;				       				       
		       }
		       if (left>0) {
			       this._x=  0;	
		       }
	
		       if (bottom<500) {
				 this._y=-(this._height-501);
		       }
	       }
	}
}