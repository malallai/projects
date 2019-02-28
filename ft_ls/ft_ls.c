/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/02 14:36:09 by bclerc            #+#    #+#             */
/*   Updated: 2019/02/28 13:17:25 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_ls.h"

int main(int argc, char **argv)
{
	t_opt opt;
	int i;

	opt.max = argc;
	i = parse(argv, &opt);
	opt.skip = i == argc ? 1 : 0;
	read_file(argv, i, &opt);
	printls(opt.folder, &opt);
	destroyls(opt.folder);
}

