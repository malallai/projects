/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   files.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 13:52:52 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 23:19:13 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		is_hidden_file(char *str)
{
	return ((str[0] == '.' && str[1] != '/') \
		|| (str[0] == '.' && str[1] == '.'));
}

int		can_print(t_opt *opt, char *str)
{
	return (has_flag(opt, F_ALL) || (!has_flag(opt, F_ALL) && \
		!is_hidden_file(str)));
}

int		to_folder(char *name, char *entry_name)
{
	char	*tmp;
	char	*tmp2;
	int		r;

	r = 0;
	if (name[ft_strlen(name) - 1] == '/')
		r = 0;
	else
	{
		tmp2 = ft_strjoin(entry_name ? entry_name : "", name);
		if (is_regular_file(tmp2))
		{
			free(tmp2);
			return (0);
		}
		free(tmp2);
		tmp = ft_strjoin(name, "/");
		tmp2 = ft_strjoin(entry_name ? entry_name : "", tmp);
		if (!is_regular_file(tmp2) && is_folder(tmp2))
			r = 1;
		free(tmp);
		free(tmp2);
	}
	return (r);
}
