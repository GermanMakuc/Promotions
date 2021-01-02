

var Slider = {
	
	/**
	 * General identifier used on #{ID}_count, #add_{ID}, #{ID}_list and #main_{ID}
	 */
	identifier: "promotion",

	/**
	 * The ID of the fusionEditor (like "#news_content"), if any, otherwise put false
	 */
	fusionEditor: false,

	/**
	 * Links for the ajax requests
	 */
	Links: {
		remove: "promotion/admin/delete/"
	},

	/**
	 * Removes an entry from the list
	 * @param  Int id
	 * @param  Object element
	 */
	remove: function(id, Realm, element)
	{
		var identifier = this.identifier,
			removeLink = this.Links.remove;

		UI.confirm("¿Desar borrar la " + identifier + "? Sólo borrará el registro, permitirá que el usuario pueda realizar más promociones y el personaje que recibió la promoción seguirá intacto.", "Si", function()
		{
			$("#" + identifier + "_count").html(parseInt($("#" + identifier + "_count").html()) - 1);

			$.get(Config.URL + removeLink + id + "/" + Realm);
			var rowid = "#"+id;
			$("#data tbody").find(rowid).remove();
			
		});
	},

	
}