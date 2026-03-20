jQuery(document).ready(function($) {
	var jqElemForms = $(".formgen-ci-dynamic-form");
	if (jqElemForms.length === 0) {
		return;
	}
	
	(function() {
		var CiDynamicForm = function(jqElem) {
			this.jqElem = jqElem;
			if (!jqElem.data("reload-url")) {
				return;
			}
			
			//content reload is necessary for bot hidden image
			this.reloadContent();
		};
		
		CiDynamicForm.prototype.reloadContent = function() {
			var that = this;
			$.get(this.jqElem.data("reload-url"), function(data) {
				that.jqElem.empty().append($($.parseHTML(data)));
			});
		};
		
		jqElemForms.each(function() {
			new CiDynamicForm($(this));
		});
	})();
});