var sortable = Sortable.create(document.getElementById('sortable-container'), {
	group: "localStorage-example",
		store: {
			/**
			 * Get the order of elements. Called once during initialization.
			 * @param	 {Sortable}	sortable
			 * @returns {Array}
			 */
			get: function (sortable) {
					var order = localStorage.getItem(sortable.options.group);
					return order ? order.split('|') : [];
			},

			/**
			 * Save the order of elements. Called onEnd (when the item is dropped).
			 * @param {Sortable}	sortable
			 */
			set: function (sortable) {
					var order = sortable.toArray();
					localStorage.setItem(sortable.options.group, order.join('|'));
			}
		}
});
