/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:19:35 by malallai          #+#    #+#             */
/*   Updated: 2019/03/17 21:42:34 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		main(int argc, char **argv)
{
	/*t_opt	*opt;
	int		i;

	opt = new_opt();
	if (argc == 1)
	{
		opt->entries->array = malloc(sizeof(char *));
		opt->entries->array[0] = ft_strdup(".");
		opt->entries->array[1] = NULL;
	}
	else
	{
		i = parse(argv, opt);
		set_opt_folders(opt, argc, argv, i);
		quicksort(opt->entries->array, 0, opt->entries->count - 1);
		split_entries(opt);
	}
	free_opt(opt);*/
	(void)argc;
	ft_putnbrln(is_regular_file(argv[1]));
	return (0);
}
