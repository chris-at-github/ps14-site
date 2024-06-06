(function () {
	'use strict';

	xna.on('documentLoaded', function() {

		document.querySelectorAll('.chart--line-chart').forEach(function(node) {
			const identifier = node.getAttribute('data-identifier');
			const settings = xna.settings.charts[identifier];

			const animationDelay = 45;
			const animations = {
				x: {
					type: 'number',
					easing: 'easeOutElastic',
					duration: animationDelay,
					from: NaN, // the point is initially skipped
					delay(ctx) {
						if (ctx.type !== 'data' || ctx.xStarted) {
							return 0;
						}
						ctx.xStarted = true;
						return ctx.index * animationDelay;
					}
				},
				y: {
					type: 'number',
					easing: 'easeOutElastic',
					duration: animationDelay,
					from: function(ctx) {
						return ctx.chart.scales.y.getPixelForValue(100);
					},
					delay(ctx) {
						if (ctx.type !== 'data' || ctx.yStarted) {
							return 0;
						}
						ctx.yStarted = true;
						return ctx.index * animationDelay;
					}
				}
			};

			const ctx = node.querySelector('.chart--canvas');
			if(ctx !== null) {
				const chart = new Chart(node.querySelector('.chart--canvas'), {
					type: 'line',
					options: {
						animations: animations,
						interaction: {
							intersect: false
						},
						maintainAspectRatio: false,
						plugins : {
							legend: false,
							tooltip: {
								backgroundColor: '#3e3e3e',
								padding: 12,
								caretPadding: 10,
								cornerRadius: 2,
								usePointStyle: true,
								boxWidth: 9,
								boxHeight: 9,
								titleFont: {
									family: "'Carlito', 'Calibri', sans-serif",
									size: 15
								},
								bodyFont: {
									family: "'Carlito', 'Calibri', sans-serif",
									size: 15
								},
								callbacks: {
									title: function(context) {
										var title = settings.axis.x.label + ': ' + context[0].label;

										if(settings.axis.x.unit !== '') {
											title += ' ' + settings.axis.x.unit;
										}

										return title;
									},
									label: function(context) {
										var label = '  ' + context.dataset.label || '';

										if(label !== '') {
											label += ': ';
										}

										if(context.parsed.y !== null) {
											label += new Intl.NumberFormat('de-DE', {
												minimumFractionDigits: 2
											}).format(context.parsed.y);

											if(settings.axis.y.unit !== '') {
												label += ' ' + settings.axis.y.unit;
											}
										}

										return label;
									}
								}
							}
						},
						scales: {
							x: {
								display: true,
								title: {
									display: true,
									text: settings.axis.x.label + ' (' + settings.axis.x.unit + ')',
									color: '#003865',
									font: {
										family: "'Carlito', 'Calibri', sans-serif",
										size: 18
									},
									padding: 14
								},
								grid: {
									borderColor: '#737373',
									tickColor: '#ececed',
									color: '#fff'
								},
								ticks: {
									font: {
										family: "'Carlito', 'Calibri', sans-serif",
										size: 13
									},
								}
							},
							y: {
								beginAtZero: false,
								display: true,
								title: {
									display: true,
									text: settings.axis.y.label + ' (' + settings.axis.y.unit + ')',
									color: '#003865',
									font: {
										family: "'Carlito', 'Calibri', sans-serif",
										size: 18
									},
									padding: 14
								},
								grid: {
									borderColor: '#737373',
									tickColor: '#ececed',
									color: '#ececed'
								},
								ticks: {
									font: {
										family: "'Carlito', 'Calibri', sans-serif",
										size: 13
									},
								}
							}
						}
					}
				});

				setTimeout(function() {
					chart.data.labels = settings.labels;
					chart.data.datasets = settings.datasets;
				}, 100);
			}
		});
	});
})();



