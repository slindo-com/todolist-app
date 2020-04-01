{{html-header}}

{{main-nav}}

{{sub-nav}}

${d.subview === 'general' ? `
	{{settings-general}}
` : ``}

${d.subview === 'team' ? `
	{{settings-team}}
` : ``}

${d.subview === 'account' ? `
	{{settings-account}}
` : ``}

{{html-footer}}

