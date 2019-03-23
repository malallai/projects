/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   paths.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/22 16:22:00 by malallai          #+#    #+#             */
/*   Updated: 2019/03/22 16:22:00 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		is_parent_path(char *str)
{
	return (ft_strequ(str, ".") || ft_strequ(str, ".."));
}

char	*join_path(char *str1, char *str2)
{
	char *tmp;
	char *tmp2;

	tmp = ft_strdup(str1);
	tmp2 = ft_strjoin(tmp, "/");
	free(tmp);
	tmp = ft_strjoin(tmp2, str2);
	free(tmp2);
	return (tmp);
}

char	*get_path(char *parent, char *file)
{
	char *tmp;

	if (!parent)
		return (file);
	if (parent[ft_strlen(parent) - 1] == '/')
	{
		tmp = ft_strjoin(parent, file);
		return (tmp);
	}
	tmp = ft_strjoin(parent, "/");
	return (ft_strcat(tmp, file));
}
