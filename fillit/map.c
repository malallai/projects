/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   map.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/11 14:07:49 by bclerc            #+#    #+#             */
/*   Updated: 2019/01/11 14:15:26 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

t_map	*new_map(t_infos *infos)
{
	t_map *map;

	map = ft_memalloc(1);
	map->size = 4;
	map->map = ft_newarray(map->size + 1, map->size);
	infos->map = map;
	return (map);
}
